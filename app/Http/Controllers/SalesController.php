<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function index()
    {
        $sales = Sale::with('product')->latest()->paginate(15);
        return view('sales.index', compact('sales'));
    }


    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('sales.create', compact('products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'nullable|string|max:255',
        ], [
            'product_id.required' => 'Produk wajib dipilih',
            'product_id.exists' => 'Produk tidak valid',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.min' => 'Jumlah minimal 1',
        ]);

        try {
            $product = Product::findOrFail($validated['product_id']);

            // Validasi stock
            if ($product->stock < $validated['quantity']) {
                return back()
                    ->withInput()
                    ->withErrors(['quantity' => "❌ Stock tidak cukup. Stock tersedia: {$product->stock}"]);
            }

            // Hitung total harga
            $total_price = $product->price * $validated['quantity'];

            // Kurangi stock
            $product->decrement('stock', $validated['quantity']);

            // Catat penjualan
            Sale::create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'total_price' => $total_price,
                'customer_name' => $validated['customer_name'] ?? 'Umum',
                'status' => 'completed',
            ]);

            // Catat history stock
            StockHistory::create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'type' => 'out',
                'reason' => 'Penjualan',
                'notes' => 'Pembeli: ' . ($validated['customer_name'] ?? 'Umum'),
            ]);

            // PERBAIKAN UTAMA 1: Gunakan rute admin.sales.index
            return redirect()->route('admin.sales.index')
                ->with('success', '✅ Penjualan berhasil dicatat!');

        } catch (\Exception $e) {
            // Notifikasi error Exception (misalnya DB down)
            return back()
                ->withInput()
                ->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('product');
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $products = Product::where('status', 'active')->get();
        return view('sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'nullable|string|max:255',
        ]);

        try {
            // Restore original stock
            $originalProduct = Product::find($sale->product_id);
            if ($originalProduct) {
                $originalProduct->increment('stock', $sale->quantity);
            }

            // Get new product
            $newProduct = Product::findOrFail($validated['product_id']);

            // Check stock availability for new quantity
            if ($newProduct->id !== $sale->product_id && $newProduct->stock < $validated['quantity']) {
                 // Jika produknya beda, dan stoknya kurang
                 return back()
                    ->withInput()
                    ->withErrors(['quantity' => "❌ Stock produk baru tidak cukup. Stock tersedia: {$newProduct->stock}"]);
            } elseif ($newProduct->id === $sale->product_id && $newProduct->stock + $sale->quantity < $validated['quantity']) {
                 // Jika produknya sama, pastikan stok yang tersedia (setelah di-restore) cukup
                 return back()
                    ->withInput()
                    ->withErrors(['quantity' => "❌ Stock tidak cukup. Stock tersedia: " . ($newProduct->stock + $sale->quantity)]);
            }

            // Deduct new stock
            $newProduct->decrement('stock', $validated['quantity']);

            // Calculate new total
            $total_price = $newProduct->price * $validated['quantity'];

            // Update sale
            $sale->update([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'total_price' => $total_price,
                'customer_name' => $validated['customer_name'] ?? 'Umum',
            ]);

            return redirect()->route('admin.sales.index')
                ->with('success', '✅ Penjualan berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', '❌ Terjadi kesalahan saat update: ' . $e->getMessage());
        }
    }

    public function destroy(Sale $sale)
    {
        try {
            // Restore stock
            $product = Product::find($sale->product_id);
            if ($product) { // Pastikan produk ada
                $product->increment('stock', $sale->quantity);
            }

            // Delete sale
            $sale->delete();

            // PERBAIKAN UTAMA 3: Gunakan rute admin.sales.index
            return redirect()->route('admin.sales.index')
                ->with('success', '✅ Penjualan berhasil dihapus dan stock telah dikembalikan!');

        } catch (\Exception $e) {
            return back()
                ->with('error', '❌ Gagal menghapus penjualan: ' . $e->getMessage());
        }
    }
}