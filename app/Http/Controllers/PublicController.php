<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Pastikan Anda mengaktifkan ini jika ingin kirim email sungguhan

class PublicController extends Controller
{
    // --- Halaman View ---
    public function index()
    {
        return view('public.index'); 
    }

    public function about()
    {
        return view('public.tentang');
    }

    public function contact()
    {
        return view('public.kontak'); 
    }

    public function menu()
    {
        // Data Dummy (Seharusnya diambil dari database)
        $products = [
            ['name' => 'Butter Croissant', 'price' => 12000, 'rating' => '★★★★★', 'image' => 'images/croissant.jpg'],
            ['name' => 'Chocolate Lava Cake', 'price' => 45000, 'rating' => '★★★★☆', 'image' => 'images/lavacake.jpg'],
            ['name' => 'Artisan Sourdough Loaf', 'price' => 35000, 'rating' => '★★★★★', 'image' => 'images/sourdough.jpg'],
            ['name' => 'Almond Danish', 'price' => 18000, 'rating' => '★★★★☆', 'image' => 'images/danish.jpg'], // Tambahkan gambar ini ke public/images/
        ];
        return view('public.produk', compact('products')); 
    }

    // --- Fungsionalitas Kontak ---
    public function sendContact(Request $request)
    {
        // 1. Validasi Input (Wajib untuk keamanan dan fungsionalitas)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);
        
        // 3. Redirect dengan pesan sukses
        return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami balas.');
    }
}