<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     * Logika: Memastikan user sudah login (dijamin oleh middleware 'auth' di web.php).
     */
    public function index()
    {

        // Cek apakah view resources/views/checkout/index.blade.php sudah ada
        if (view()->exists('checkout.index')) {
            return view('checkout.index', [
                'user' => Auth::user(),
                // Anda mungkin perlu me-load data keranjang di sini dari session/database
            ]);
        } else {
            // Jika halaman checkout belum dibuat, tampilkan pesan sederhana
            return "Halaman Checkout sedang dalam pengembangan.";
        }
    }
}