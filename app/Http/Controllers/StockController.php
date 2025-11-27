<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = StockHistory::with('product')->latest()->paginate(15);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::where('status', 'active')->get();
        return view('stocks.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $product = Product::find($request->product_id);

        // Update stock produk
        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            if ($product->stock < $request->quantity) {
                return back()->withErrors(['quantity' => 'Stock tidak cukup']);
            }
            $product->decrement('stock', $request->quantity);
        }

        // Catat history
        StockHistory::create($request->all());

        return redirect()->route('admin.stocks.index')->with('success', 'Stock berhasil dicatat');
    }
}
