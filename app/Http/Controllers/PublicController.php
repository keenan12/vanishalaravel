<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage; // <--- Diimpor jika Anda perlu mengakses Storage

class PublicController extends Controller
{
    /**
     * Tampilkan Halaman Utama (Homepage)
     * Menggunakan limit 6 produk terbaru (sesuai kode asli Anda).
     */
    public function index()
    {
        // Mengambil hanya 6 produk aktif terbaru untuk ditampilkan di homepage
        $products = Product::with('category')
                            ->where('status', 'active')
                            ->orderBy('created_at', 'desc')
                            ->limit(6) // <-- Batasan 6 produk hanya di homepage
                            ->get();

        // Asumsi view untuk homepage adalah public.index
        return view('public.index', compact('products')); 
    }

    /**
     * Tampilkan Halaman Tentang Kami.
     */
    public function about()
    {
        return view('public.tentang');
    }

    /**
     * Tampilkan Halaman Kontak.
     */
    public function contact()
    {
        return view('public.kontak'); 
    }

    /**
     * Tampilkan Halaman Menu Produk dengan Filter dan Pagination.
     * Menggunakan paginate(12) agar semua produk muncul dalam beberapa halaman.
     */
    public function menu(Request $request)
    {
        // 1. Ambil semua kategori untuk filter dropdown
        $categories = Category::orderBy('name')->get(); 

        // 2. Mulai query Produk
        // Hanya ambil produk yang statusnya 'active'
        $productsQuery = Product::where('status', 'active')
                                 ->with('category')
                                 ->orderBy('name');
        
        // 3. Logika Filtering berdasarkan Kategori
        if ($request->filled('category_id')) {
            $productsQuery->where('category_id', $request->input('category_id'));
        }

        // 4. Eksekusi query dengan Pagination
        // Semua produk aktif akan tampil, dibagi per 12 item per halaman
        $products = $productsQuery->paginate(12)->withQueryString(); 

        // 5. Kirim data ke view public.produk
        return view('public.produk', compact('products', 'categories'));
    }

    /**
     * Proses pengiriman form kontak.
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'message'   => 'required|string|min:10',
        ]);

        // Opsional: Logika pengiriman email di sini
        // Mail::to('admin@domain.com')->send(new ContactMail($request->all()));
        
        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami balas.');
    }
}