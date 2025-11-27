<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category'); 

        // Filtering
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('category_id')) { 
            $query->where('category_id', $request->input('category_id'));
        }

        // Sorting
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');
        if (in_array($sort, ['id', 'name', 'price', 'stock', 'created_at'])) {
            $query->orderBy($sort, $direction);
        }

        $products = $query->paginate(10)->withQueryString();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function menu()
    {
        $products = Product::where('status', 'active')
                           ->with('category')
                           ->orderBy('created_at', 'desc')
                           ->paginate(12); 
        
        $categories = Category::orderBy('name')->get();

        return view('public.produk', compact('products', 'categories')); 
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // --- METODE STORE (PERBAIKAN UTAMA) ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'status' => 'required|in:active,inactive',
        ]);

        try {
            if ($request->hasFile('image')) {
                // PERBAIKAN: Menggunakan disk 'public' secara eksplisit
                // File akan disimpan di: storage/app/public/products/namaacak.jpg
                $path = $request->file('image')->store('products', 'public'); 
                
                // Simpan URL publik ke database: /storage/products/namaacak.jpg
                $validated['image'] = Storage::url($path); 
            }
            
            Product::create($validated);
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // --- METODE UPDATE (PERBAIKAN UTAMA) ---
    public function update(Request $request, Product $product)
    {
        // 1. Logika Hapus Gambar via Checkbox
        if ($request->has('remove_image') && $product->image) {
            try {
                // Bersihkan path untuk disk 'public' (hapus '/storage/')
                $relativePath = str_replace('/storage/', '', $product->image);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
                
                $product->image = NULL; 
                $product->save(); 
                
                if (!$request->hasFile('image')) {
                    return redirect()->route('admin.products.index')->with('success', '✅ Gambar dihapus!');
                }
            } catch (\Exception $e) {
                \Log::error('Error hapus gambar: ' . $e->getMessage());
            }
        }

        // 2. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id . '|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'status' => 'required|in:active,inactive',
        ]);

        try {
            // 3. Logika Upload Gambar Baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($product->image) {
                    $oldPath = str_replace('/storage/', '', $product->image);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                
                // Upload baru ke disk 'public'
                $path = $request->file('image')->store('products', 'public');
                $validated['image'] = Storage::url($path);
            } else {
                // Jangan ubah field image jika tidak ada upload baru
                unset($validated['image']); 
            }
            
            $product->update($validated);
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk diperbarui!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                $relativePath = str_replace('/storage/', '', $product->image);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk dihapus!');
            
        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal menghapus: ' . $e->getMessage());
        }
    }
}