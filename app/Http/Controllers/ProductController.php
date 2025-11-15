<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::query();

        // Pencarian berdasarkan nama atau SKU
        if (request('search')) {
            $search = request('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Sorting
        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');
        
        if (in_array($sort, ['name', 'price', 'stock', 'created_at'])) {
            $query->orderBy($sort, $direction);
        }

        $products = $query->paginate(10);
        
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products|max:50',
            'status' => 'required|in:active,inactive',
        ], [
            'name.unique' => 'Nama produk sudah ada di database',
            'sku.unique' => 'SKU produk sudah ada, gunakan yang berbeda',
            'price.min' => 'Harga minimal Rp 1.000',
            'price.required' => 'Harga wajib diisi',
            'stock.required' => 'Stock wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori yang dipilih tidak valid',
        ]);

        try {
            Product::create($request->all());
            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id . '|max:50',
            'status' => 'required|in:active,inactive',
        ], [
            'name.unique' => 'Nama produk sudah ada di database',
            'sku.unique' => 'SKU produk sudah ada, gunakan yang berbeda',
            'price.min' => 'Harga minimal Rp 1.000',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori yang dipilih tidak valid',
        ]);

        try {
            $product->update($request->all());
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}
