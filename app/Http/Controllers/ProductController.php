<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    /**
     * Tampilkan Daftar Produk (Admin Panel) dengan Filter.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown filter di view
        $categories = Category::all();

        // Mulai query Produk
        $query = Product::with('category'); 

        // --- Logika Filtering ---
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

        // --- Logika Sorting ---
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');
        
        if (in_array($sort, ['id', 'name', 'price', 'stock', 'created_at'])) {
            $query->orderBy($sort, $direction);
        }

        $products = $query->paginate(10)->withQueryString();
        
        // Mengirim data kategori dan produk ke view
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Metode untuk Tampilan Publik (Menu).
     */
    public function menu()
    {
        // Ambil semua produk yang berstatus 'active'
        $products = Product::where('status', 'active')
                           ->with('category') // Tambahkan with('category') jika data kategori digunakan di view
                           ->orderBy('created_at', 'desc')
                           ->get(); 
        
        // Memanggil view public/produk.blade.php
        return view('public.produk', compact('products')); 
    }

    /**
     * Tampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Simpan (Store) produk baru ke database, termasuk upload gambar.
     */
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
        ], [
            'name.unique' => 'Nama produk sudah ada di database',
            'sku.unique' => 'SKU produk sudah ada, gunakan yang berbeda',
            'price.min' => 'Harga minimal Rp 1.000',
            'category_id.required' => 'Kategori wajib dipilih',
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/products'); 
                $validated['image'] = Storage::url($imagePath); // Simpan path URL publik
            }
            
            Product::create($validated);
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ Terjadi kesalahan saat menyimpan produk: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk ke database, termasuk penggantian atau penghapusan gambar.
     */
    public function update(Request $request, Product $product)
    {
        // --- LOGIKA PENGHAPUSAN GAMBAR DARI CHECKBOX ---
        if ($request->has('remove_image') && $product->image) {
            try {
                // Hapus file fisik (konversi /storage/... ke public/...)
                Storage::delete(str_replace('/storage', 'public', $product->image));
                
                // Set field 'image' di database menjadi NULL
                $product->image = NULL; 
                $product->save(); 
                
                // Jika hanya menghapus gambar dan tidak ada file baru di-upload, selesai.
                if (!$request->hasFile('image')) {
                    return redirect()->route('admin.products.index')->with('success', '✅ Gambar produk berhasil dihapus!');
                }
                
            } catch (\Exception $e) {
                \Log::error('Gagal menghapus gambar lama: ' . $e->getMessage());
            }
        }
        // --------------------------------------------------------------------

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
            // Logika Update Gambar BARU
            if ($request->hasFile('image')) {
                // Hapus gambar lama (jika ada) saat gambar baru di-upload
                if ($product->image) {
                    Storage::delete(str_replace('/storage', 'public', $product->image)); 
                }
                $imagePath = $request->file('image')->store('public/products');
                $validated['image'] = Storage::url($imagePath);
            } else {
                // Hapus key 'image' dari $validated agar tidak menimpa data gambar lama 
                // jika tidak ada file baru di-upload DAN tidak ada request hapus.
                unset($validated['image']); 
            }
            
            $product->update($validated);
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ Terjadi kesalahan saat update produk: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk dari database dan storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Logika Hapus Gambar Fisik
            if ($product->image) {
                // Konversi path /storage/... menjadi public/... sebelum dihapus
                Storage::delete(str_replace('/storage', 'public', $product->image));
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil dihapus!');
            
        } catch (\Exception $e) {
            return back()->with('error', '❌ Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}