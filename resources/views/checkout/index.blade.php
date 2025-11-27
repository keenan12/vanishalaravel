@extends('layouts.public') {{-- Gunakan layout utama Anda --}}

@section('title', 'Proses Pembayaran')

@section('content')
<div class="container" style="max-width: 900px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <h1 style="color: var(--vanisha-red); border-bottom: 2px solid #eee; padding-bottom: 10px;">
        <i class="fas fa-shipping-fast" style="margin-right: 10px;"></i> Konfirmasi Checkout
    </h1>
    
    <p class="lead">
        Selamat, {{ Auth::user()->name }}! Anda berhasil masuk ke halaman pembayaran.
    </p>
    
    <div style="padding: 20px; background: #fff7ed; border: 1px dashed var(--vanisha-orange); border-radius: 6px; margin-top: 20px;">
        <h3 style="color: var(--vanisha-orange);">Langkah Selanjutnya:</h3>
        <p>1. Review Pesanan: Tampilkan daftar produk dan total akhir.</p>
        <p>2. Alamat Pengiriman: Konfirmasi atau masukkan alamat Anda.</p>
        <p>3. Metode Pembayaran: Pilih metode yang Anda inginkan (misal: Transfer Bank, E-Wallet).</p>
        
        <p style="margin-top: 15px; font-weight: 600;">Saat ini, halaman ini hanya sebagai *placeholder*. Implementasi formulir akan dilakukan di sini.</p>
    </div>
    
    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ url('/') }}" style="text-decoration: none; color: #666; font-weight: 500;">
            <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Kembali ke Beranda
        </a>
    </div>

</div>
@endsection