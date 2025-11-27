<!DOCTYPE html>

<html lang="en" style="scroll-behavior: smooth;"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vanisha Bakery')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --vanisha-brown: #6b2b12;
            --vanisha-footer: #4b1e0e;
            --vanisha-orange: #f97316;
            --vanisha-gold: #facc15;
            --vanisha-red: #b91c1c; 
        }
        /* FIX: Sembunyikan elemen Alpine sebelum diinisialisasi */
        [x-cloak] { 
            display: none !important; 
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #111827;
            background-color: #f7f7f7; 
        }
        .nav-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background-color: var(--vanisha-brown);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }
        .nav-inner {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 16px;
            height: 60px; 
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 24px; 
            text-decoration: none;
            color: #fff;
        }
        .nav-logo span:first-child {
            color: var(--vanisha-gold);
        }
        .nav-menu {
            display: none; 
            gap: 24px;
            font-size: 15px;
            font-weight: 500;
        }
        .nav-menu a {
            color: #fff;
            text-decoration: none;
            padding: 5px 0;
            transition: color 0.2s;
        }
        .nav-menu a:hover {
            color: var(--vanisha-gold);
        }
        .menu-toggle {
            display: block; 
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
            margin-left: 15px;
        }
        @media (min-width: 768px) { 
            .nav-menu {
                display: flex;
            }
            .menu-toggle {
                display: none; 
            }
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .btn-login {
            display: inline-block;
            padding: 8px 18px; 
            border-radius: 999px;
            background-color: var(--vanisha-orange);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.2s;
        }
        .btn-login:hover {
            background-color: #ea580c;
            transform: scale(1.05);
        }
        
        /* FIX BUG KERANJANG & Styling Badge */
        .nav-cart {
            position: relative;
            cursor: pointer;
            transition: transform 0.2s;
            padding: 5px; 
            margin-right: 10px; 
        }
        .nav-cart:hover {
            transform: scale(1.1);
        }
        .nav-cart i {
            font-size: 20px;
        }
        .nav-cart .badge {
            position: absolute;
            top: -5px; 
            right: -2px; 
            background-color: var(--vanisha-red) !important; 
            color: #fff;
            font-size: 10px;
            border-radius: 999px;
            padding: 1px 6px;
            min-width: 18px;
            text-align: center;
            font-weight: 700;
            border: 2px solid var(--vanisha-brown);
            line-height: 1.4; 
        }

        /* Styling Quantity Control */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
        }
        .quantity-control button {
            background-color: var(--vanisha-orange);
            color: white;
            border: none;
            width: 25px; /* Dibuat sedikit lebih besar */
            height: 25px;
            border-radius: 4px;
            font-weight: 700;
            line-height: 1;
            padding: 0;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .quantity-control button:hover {
            background-color: #ea580c;
        }
        .quantity-control span {
            font-size: 14px;
            font-weight: 600;
            width: 20px;
            text-align: center;
        }

        /* Tombol Checkout dan Whatsapp dibuat rata tengah */
        .checkout-buttons {
             display: flex;
             flex-direction: column;
             align-items: center; /* Meratakan ke tengah */
             width: 100%;
        }
        .checkout-buttons a, .checkout-buttons button {
            width: 90%; /* Memberi sedikit margin dari pinggir drawer */
            max-width: 280px; 
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center; /* Rata tengah teks dan icon */
        }
    </style>
</head>
<body x-data="{ ...$store.ui }">

<header class="nav-wrapper">
    <div class="nav-inner">
        <a href="{{ url('/') }}" class="nav-logo">
            <span>Vanisha</span><span>&nbsp;Bakery</span>
        </a>

        <nav class="nav-menu">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/#menu') }}">Menu</a>
            <a href="{{ url('/#about') }}">About</a>
            <a href="{{ url('/#contact') }}">Contact</a>
        </nav>

        <div class="nav-actions">

{{-- LOGIKA AUTHENTICATION (User vs Guest) --}}
@guest
    <a href="{{ route('login') }}" class="btn-login">Sign In</a>
@endguest

@auth
    <div class="user-dropdown" x-data="{ open: false }" @click.outside="open = false">
        <div class="user-trigger" @click="open = ! open">
            <span>Halo, {{ Auth::user()->name }}</span>
            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open && 'rotate-180'"></i> 
        </div>

        <div class="dropdown-menu" x-show="open" x-transition x-cloak>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item btn-logout">
                    <i class="fas fa-sign-out-alt" style="margin-right:8px;"></i> Logout
                </button>
            </form>
        </div>
    </div>
@endauth

{{-- Cart Icon (Perbaikan Tampilan Keranjang) --}}
<div class="nav-cart" @click="$store.ui.cartOpen = true">
    <i class="fas fa-shopping-cart"></i>
    <span class="badge rounded-pill" x-text="$store.cart.count" x-cloak>0</span>
</div>

<div class="menu-toggle" @click="$store.ui.navOpen = ! $store.ui.navOpen">
    <i :class="$store.ui.navOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
</div>

</div>
</div>
</header>

<div class="mobile-menu-drawer"
     :class="$store.ui.navOpen && 'open'"
     x-cloak
     @click.outside="$store.ui.navOpen = false"
     @keydown.escape.window="$store.ui.navOpen = false">
    <a href="{{ url('/') }}" @click="$store.ui.navOpen = false">Home</a>
    <a href="{{ url('/#menu') }}" @click="$store.ui.navOpen = false">Menu</a>
    <a href="{{ url('/#about') }}" @click="$store.ui.navOpen = false">About</a>
    <a href="{{ url('/#contact') }}" @click="$store.ui.navOpen = false">Contact</a>
    @guest
        <a href="{{ route('login') }}" style="margin-top:10px; border-top: 1px solid rgba(255,255,255,0.1);" @click="$store.ui.navOpen = false">Sign In</a>
    @endguest
</div>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-inner">
        <p>© 2024 Vanisha Bakery. All rights reserved.</p>
        <div class="footer-social">
            <span>Follow us:</span>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-tiktok"></i>
        </div>
    </div>
</footer>

{{-- CART DRAWER --}}
<div x-show="$store.ui.cartOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-x-full"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 translate-x-full"
     x-cloak
     @click.outside="$store.ui.cartOpen = false"
     style="position: fixed; top: 0; right: 0; width: 320px; max-width: 90vw; height: 100%; 
             background-color: white; box-shadow: -4px 0 10px rgba(0,0,0,0.15);
             z-index: 2000; padding: 20px; display: flex; flex-direction: column;">

    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #ddd; padding-bottom:10px; margin-bottom:15px;">
        <h3 style="font-size:20px; font-weight:700; color:var(--vanisha-red);">Shopping Cart</h3>
        <button @click="$store.ui.cartOpen = false" style="background:none; border:none; font-size:20px; cursor:pointer; color:#999; line-height:1;">&times;</button>
    </div>

    <div style="flex-grow:1; overflow-y:auto; margin-bottom:15px; display:flex; flex-direction:column; gap:12px;">
        <template x-for="(item, index) in $store.cart.items" :key="index">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; padding:8px 0; border-bottom:1px dashed #eee;">
                
                {{-- KIRI: Nama Produk & Harga --}}
                <div style="flex-grow: 1;">
                    <p style="font-weight:600; font-size:14px; margin-bottom: 2px;"
                        x-text="item.name"></p>
                    
                    <p style="font-size:12px; color:#999; margin-bottom: 5px;"
                        x-text="`Harga Satuan: ${$store.cart.formatRupiah(item.price)}`"></p>
                    
                    <p style="font-size:13px; color:var(--vanisha-red); font-weight:700; margin-bottom: 5px;"
                        x-text="`Subtotal: ${$store.cart.formatRupiah(item.price * item.quantity)}`"></p>

                    {{-- QUANTITY CONTROL (+/-) --}}
                    <div class="quantity-control">
                        <button @click="$store.cart.decrementItem(index)" 
                                style="background-color: var(--vanisha-red);">&minus;</button>
                        <span x-text="item.quantity">1</span>
                        <button @click="$store.cart.incrementItem(index)">&plus;</button>
                    </div>
                </div>
                
                {{-- KANAN: Tombol Hapus --}}
                <button style="background:var(--vanisha-red); color:white; border:none; border-radius:4px; padding:4px 8px; font-size:11px; cursor:pointer; height: min-content; margin-top: 15px;"
                        @click="$store.cart.removeItem(index)">
                    Hapus
                </button>
            </div>
        </template>
        <p x-show="$store.cart.items.length === 0"
            style="text-align:center; color:#999; font-size:14px; padding:20px 0;">
            Keranjang kosong. Yuk, tambahkan roti favorit Anda!
        </p>
    </div>

    <div style="border-top:2px solid var(--vanisha-red); padding-top:10px; text-align:right; font-size:18px; font-weight:800; color:var(--vanisha-red);">
        Total:
        <span x-text="$store.cart.formatRupiah($store.cart.total)">Rp0</span>
    </div>

    {{-- Logika Tombol Checkout (DIRATAKAN TENGAH) --}}
    <div class="checkout-buttons">
        @guest
            <a href="{{ route('login') }}"
                style="margin-top:15px; padding:12px; border-radius:999px; border:none; text-align:center;
                        background:var(--vanisha-red); color:white; font-size:15px; font-weight:700; cursor:pointer;
                        transition:background 0.3s; text-decoration:none;"
                onmouseover="this.style.backgroundColor='#991b1b'" 
                onmouseout="this.style.backgroundColor='var(--vanisha-red)'"
                @click="$store.ui.cartOpen = false">
                <i class="fas fa-lock" style="margin-right:8px;"></i> Checkout (Login Dibutuhkan)
            </a>
        @else
            {{-- Lanjut ke Pembayaran --}}
            <button style="margin-top:15px; padding:12px; border-radius:999px; border:none;
                            background:var(--vanisha-orange); color:white; font-size:15px; font-weight:700; cursor:pointer;
                            transition:background 0.3s;"
                    onmouseover="this.style.backgroundColor='#ea580c'" 
                    onmouseout="this.style.backgroundColor='var(--vanisha-orange)'"
                    @click="$store.cart.checkoutToPayment()"> 
                <i class="fas fa-money-check-alt" style="margin-right:8px;"></i> Lanjut ke Pembayaran
            </button>
            
            {{-- Checkout via WhatsApp --}}
            <button style="margin-top:10px; padding:12px; border-radius:999px; border:1px solid var(--vanisha-orange);
                            background:white; color:var(--vanisha-orange); font-size:15px; font-weight:700; cursor:pointer;
                            transition:background 0.3s;"
                    onmouseover="this.style.backgroundColor='#fff7ed'" 
                    onmouseout="this.style.backgroundColor='white'"
                    @click="$store.cart.checkoutWhatsapp()">
                <i class="fab fa-whatsapp" style="margin-right:8px;"></i> Checkout via WhatsApp
            </button>
        @endguest
    </div>

</div>

{{-- ---------------------------------------------------------------------------------------------------------------- --}}
{{-- STRUKTUR TOAST UNTUK NOTIFIKASI --}}
{{-- ---------------------------------------------------------------------------------------------------------------- --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2001;">
    <div id="successToastTemplate" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
        <div class="toast-header" style="background-color: var(--vanisha-orange) !important; color: white;">
            <strong class="me-auto">Vanisha Bakery</strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="color: #333;">
            <i class="fas fa-check-circle me-2"></i> Produk berhasil ditambahkan ke keranjang.
        </div>
    </div>
</div>

{{-- SCRIPT BOOTSTRAP WAJIB UNTUK TOAST --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>