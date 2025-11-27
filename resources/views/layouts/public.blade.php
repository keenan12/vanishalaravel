<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vanisha Bakery')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- CSS NAVBAR & LAYOUT SEDERHANA --}}
    <style>
        :root {
            --vanisha-brown: #6b2b12;
            --vanisha-footer: #4b1e0e;
            --vanisha-orange: #f97316;
            --vanisha-gold: #facc15;
        }
        /* [1] FIX: Sembunyikan elemen Alpine sebelum diinisialisasi */
        [x-cloak] { 
            display: none !important; 
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #111827;
        }
        .nav-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background-color: var(--vanisha-brown);
            color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .nav-inner {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 16px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 20px;
            text-decoration: none;
            color: #fff;
        }
        .nav-logo span:first-child {
            color: var(--vanisha-gold);
        }
        .nav-menu {
            display: flex;
            gap: 24px;
            font-size: 14px;
            font-weight: 500;
        }
        .nav-menu a {
            color: #fff;
            text-decoration: none;
        }
        .nav-menu a:hover {
            color: var(--vanisha-gold);
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px; /* Diperlebar sedikit */
        }
        .btn-login {
            display: inline-block;
            padding: 6px 16px; /* Diperbaiki */
            border-radius: 999px;
            background-color: var(--vanisha-orange);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn-login:hover {
            background-color: #ea580c;
        }
        .nav-cart {
            position: relative;
            cursor: pointer;
        }
        .nav-cart i {
            font-size: 18px;
        }
        .nav-cart span {
            position: absolute;
            top: -6px;
            right: -8px;
            background-color: var(--vanisha-orange);
            color: #fff;
            font-size: 10px;
            border-radius: 999px;
            padding: 0 4px;
            min-width: 14px;
            text-align: center;
            font-weight: 700;
        }
        
        /* [2] TAMBAHAN CSS UNTUK DROPDOWN USER */
        .user-dropdown {
            position: relative;
        }
        .user-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s;
        }
        .user-trigger:hover {
             color: var(--vanisha-gold);
        }
        .dropdown-menu {
            position: absolute;
            top: 140%; 
            right: 0;
            background-color: white;
            color: #333;
            min-width: 160px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
            z-index: 100; /* Pastikan di atas elemen lain */
        }
        .dropdown-item {
            display: block;
            padding: 10px 16px;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            transition: background 0.2s;
        }
        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: var(--vanisha-brown);
        }
        .btn-logout {
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            color: #dc2626; 
            font-weight: 600;
        }
        .btn-logout:hover {
            background-color: #fef2f2;
        }

        main {
            padding-top: 64px;
        }
        /* ... CSS Footer & Media Queries ... */
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
    
    {{-- KONDISI 1: Jika User BELUM Login (Guest) --}}
    @guest
        <a href="{{ route('login') }}" class="btn-login">Sign In</a>
    @endguest

    {{-- KONDISI 2: Jika User SUDAH Login (Auth) --}}
    @auth
        {{-- Dropdown hanya untuk Logout --}}
        <div class="user-dropdown" x-data="{ open: false }">
            <div class="user-trigger" 
                 @click="open = ! open">
                <span>Halo, {{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" 
                   :class="open && 'rotate-180'"></i> 
            </div>

            <div class="dropdown-menu" 
                 x-show="open"
                 x-transition 
                 @click.outside="open = false"
                 x-cloak>
                
                {{-- MENGHILANGKAN: Dashboard Saya & Edit Profil --}}
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item btn-logout">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    @endauth

    {{-- Cart Icon --}}
    <div class="nav-cart" @click="$store.ui.cartOpen = true">
        <i class="fas fa-shopping-cart"></i>
        <span x-text="$store.cart.count">0</span>
    </div>

</div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-inner">
            <p>© 2024 Vanisha Bakery. All rights reserved.</p>
            <div class="footer-social">
                <span>Follow us</span>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-tiktok"></i>
            </div>
        </div>
    </footer>

    {{-- CART DRAWER --}}
    <div x-show="$store.ui.cartOpen"
         x-transition
         x-cloak
         class="fixed top-0 right-0 w-80 md:w-[320px] h-full bg-white shadow-2xl
                z-[2000] p-5 flex flex-col">
        <h3 class="text-xl font-bold text-vanisha-red mb-4 border-b pb-2">Shopping Cart</h3>

        <div class="grow overflow-y-auto space-y-3 mb-3">
            <template x-for="(item, index) in $store.cart.items" :key="index">
                <div class="flex justify-between items-center py-2 border-b">
                    <div>
                        <p class="font-semibold text-sm"
                           x-text="`${item.name} (x${item.quantity})`"></p>
                        <p class="text-xs text-gray-500"
                           x-text="$store.cart.formatRupiah(item.price * item.quantity)"></p>
                    </div>
                    <button class="text-red-600 text-sm"
                            @click="$store.cart.removeItem(index)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </template>
            <p x-show="$store.cart.items.length === 0"
               class="text-center text-gray-500 text-sm py-6">
                Keranjang kosong.
            </p>
        </div>

        <div class="border-t pt-2 text-right text-lg font-bold text-vanisha-red">
            Total:
            <span x-text="$store.cart.formatRupiah($store.cart.total)">Rp0</span>
        </div>

        <button class="mt-3 bg-vanisha-orange hover:bg-vanisha-orange-dark text-white py-2
                        rounded-md text-sm font-semibold"
                @click="$store.cart.checkout()">
            Checkout
        </button>
        <button class="mt-2 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 rounded-md
                        text-sm font-semibold"
                @click="$store.ui.cartOpen = false">
            Close
        </button>
    </div>

</body>
</html>