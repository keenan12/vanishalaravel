<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vanisha Bakery')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --vanisha-brown: #6b2b12;
            --vanisha-footer: #4b1e0e;
            --vanisha-orange: #f97316;
            --vanisha-gold: #facc15;
            --vanisha-red: #b91c1c; 
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        [x-cloak] { display: none !important; }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #111827;
            background-color: #f7f7f7; 
        }

        /* NAVBAR */
        .nav-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background-color: var(--vanisha-brown);
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
            gap: 15px;
        }
        .btn-login {
            padding: 8px 18px; 
            border-radius: 999px;
            background-color: var(--vanisha-orange);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #ea580c;
            transform: scale(1.05);
            color: #fff;
        }
        
        /* USER DROPDOWN */
        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background-color 0.2s;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
        }

        .user-trigger:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-trigger i {
            font-size: 12px;
            transition: transform 0.2s ease;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            left: auto;
            background: transparent;
            border: none;
            box-shadow: none;
            z-index: 100;
            display: none;
            min-width: 100%;
        }

        .dropdown-menu.show {
            display: flex;
            justify-content: center;
        }

        .dropdown-item {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            border: none;
            background: var(--vanisha-brown);
            color: var(--vanisha-gold);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
            border-radius: 999px;
            box-shadow: 0 4px 12px rgba(107, 43, 18, 0.4);
        }

        .dropdown-item i {
            font-size: 13px;
            margin-right: 6px;
        }

        .dropdown-item:hover {
            background: var(--vanisha-orange);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249, 115, 22, 0.5);
        }
        
        /* CART */
        .nav-cart {
            position: relative;
            cursor: pointer;
            transition: transform 0.2s;
            padding: 5px;
        }
        .nav-cart:hover {
            transform: scale(1.1);
        }
        .nav-cart i {
            font-size: 20px;
            color: #fff;
        }
        .nav-cart .badge {
            position: absolute;
            top: -5px; 
            right: -5px; 
            background-color: var(--vanisha-red) !important; 
            color: #fff;
            font-size: 10px;
            border-radius: 999px;
            padding: 2px 6px;
            min-width: 18px;
            text-align: center;
            font-weight: 700;
            border: 2px solid var(--vanisha-brown);
        }

        /* MOBILE MENU */
        .mobile-menu-drawer {
            position: fixed;
            top: 60px;
            left: -100%;
            width: 250px;
            height: calc(100vh - 60px);
            background-color: var(--vanisha-brown);
            transition: left 0.3s ease;
            z-index: 40;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .mobile-menu-drawer.open {
            left: 0;
        }
        .mobile-menu-drawer a,
        .mobile-menu-drawer button {
            color: #fff;
            text-decoration: none;
            padding: 10px 0;
            font-size: 15px;
            font-weight: 500;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            transition: color 0.2s;
            width: 100%;
        }
        .mobile-menu-drawer a:hover,
        .mobile-menu-drawer button:hover {
            color: var(--vanisha-gold);
        }
        
        @media (min-width: 768px) {
            .mobile-menu-drawer {
                display: none !important;
            }
        }

        /* FEATURE CARDS */
        .feature-card {
            text-align: center;
            padding: 30px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .feature-card img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin: 0 auto 20px;
            display: block;
        }
        .feature-card h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--vanisha-brown);
            margin-bottom: 12px;
        }
        .feature-card p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* QUANTITY CONTROL */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 5px;
        }
        .quantity-control button {
            background-color: var(--vanisha-orange);
            color: white;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            font-weight: 700;
            line-height: 1;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .quantity-control button:hover {
            background-color: #ea580c;
        }
        .quantity-control span {
            font-size: 14px;
            font-weight: 600;
            min-width: 25px;
            text-align: center;
        }

        /* CHECKOUT BUTTONS */
        .checkout-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }
        .checkout-buttons button,
        .checkout-buttons a {
            width: 100%;
            padding: 12px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        .btn-checkout-primary {
            background: var(--vanisha-orange);
            color: white;
        }
        .btn-checkout-primary:hover {
            background: #ea580c;
        }
        .btn-checkout-secondary {
            background: white;
            color: var(--vanisha-orange);
            border: 2px solid var(--vanisha-orange) !important;
        }
        .btn-checkout-secondary:hover {
            background: #fff7ed;
        }

        /* FOOTER */
        footer {
            background-color: var(--vanisha-footer);
            color: #fff;
            padding: 30px 20px;
            margin-top: 60px;
        }
        .footer-inner {
            max-width: 1120px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .footer-social {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .footer-social i {
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .footer-social i:hover {
            color: var(--vanisha-gold);
        }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }
        .footer-creators {
            text-align: right;
        }
        .footer-creators strong {
            color: var(--vanisha-gold);
        }
        @media (max-width: 768px) {
            .footer-content,
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            .footer-creators {
                text-align: center;
            }
        }

        main {
            padding-top: 60px;
        }

        /* CART DRAWER */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1999;
            display: none;
        }
        .cart-overlay.show {
            display: block;
        }
        .cart-drawer {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            max-width: 90vw;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 15px rgba(0,0,0,0.2);
            z-index: 2000;
            padding: 20px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: right 0.3s ease;
        }
        .cart-drawer.show {
            right: 0;
        }
    </style>

    {{-- Alpine Cart Store --}}
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            items: JSON.parse(localStorage.getItem('vanisha_cart') || '[]'),
            drawerOpen: false,
            
            get count() {
                return this.items.reduce((sum, item) => sum + item.quantity, 0);
            },
            
            get total() {
                return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },
            
            addItem(product) {
                console.log('Adding to cart:', product);
                const existingItem = this.items.find(item => item.id === product.id);
                
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    this.items.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        quantity: 1
                    });
                }
                
                this.save();
                this.showNotification(product.name);
                this.updateBadge();
            },
            
            removeItem(index) {
                this.items.splice(index, 1);
                this.save();
                this.updateBadge();
            },
            
            incrementItem(index) {
                this.items[index].quantity++;
                this.save();
                this.updateBadge();
            },
            
            decrementItem(index) {
                if (this.items[index].quantity > 1) {
                    this.items[index].quantity--;
                } else {
                    this.removeItem(index);
                }
                this.save();
                this.updateBadge();
            },
            
            toggleDrawer() {
                this.drawerOpen = !this.drawerOpen;
                const drawer = document.getElementById('cartDrawer');
                const overlay = document.getElementById('cartOverlay');
                if (this.drawerOpen) {
                    drawer.classList.add('show');
                    overlay.classList.add('show');
                } else {
                    drawer.classList.remove('show');
                    overlay.classList.remove('show');
                }
            },
            
            closeDrawer() {
                this.drawerOpen = false;
                document.getElementById('cartDrawer').classList.remove('show');
                document.getElementById('cartOverlay').classList.remove('show');
            },
            
            save() {
                localStorage.setItem('vanisha_cart', JSON.stringify(this.items));
            },
            
            updateBadge() {
                const badge = document.getElementById('cartCount');
                if (badge) {
                    if (this.count > 0) {
                        badge.style.display = 'block';
                        badge.textContent = this.count;
                    } else {
                        badge.style.display = 'none';
                    }
                }
            },
            
            showNotification(productName) {
                setTimeout(() => {
                    const toastEl = document.getElementById('successToast');
                    if (toastEl && typeof bootstrap !== 'undefined') {
                        const toastBody = toastEl.querySelector('.toast-body');
                        toastBody.innerHTML = '<i class="fas fa-check-circle me-2" style="color: #10b981;"></i> <strong>' + productName + '</strong> ditambahkan ke keranjang!';
                        const toast = new bootstrap.Toast(toastEl, { animation: true, autohide: true, delay: 3000 });
                        toast.show();
                    }
                }, 100);
            },
            
            formatRupiah(amount) {
                return 'Rp' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            if (Alpine.store('cart')) {
                Alpine.store('cart').updateBadge();
            }
        }, 200);
    });
    </script>
</head>
<body>

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
            @guest
                <a href="{{ route('login') }}" class="btn-login">Sign In</a>
            @endguest

            @auth
                <div class="user-dropdown">
                    <div class="user-trigger" onclick="toggleDropdown()">
                        <span>Halo, {{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down" id="dropdownIcon"></i>
                    </div>

                    <div class="dropdown-menu" id="userDropdown">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            <div class="nav-cart" onclick="Alpine.store('cart').toggleDrawer()">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge" id="cartCount" style="display: none;">0</span>
            </div>

            <div class="menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars" id="menuIcon"></i>
            </div>
        </div>
    </div>
</header>

<div class="mobile-menu-drawer" id="mobileMenu">
    <a href="{{ url('/') }}" onclick="closeMobileMenu()">Home</a>
    <a href="{{ url('/#menu') }}" onclick="closeMobileMenu()">Menu</a>
    <a href="{{ url('/#about') }}" onclick="closeMobileMenu()">About</a>
    <a href="{{ url('/#contact') }}" onclick="closeMobileMenu()">Contact</a>
    
    @guest
        <a href="{{ route('login') }}" style="margin-top: 10px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2);">Sign In</a>
    @endguest
    
    @auth
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 10px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2);">
            @csrf
            <button type="submit" style="color: var(--vanisha-gold);">
                <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout
            </button>
        </form>
    @endauth
</div>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-content">
            <div>
                <h3 style="font-size: 20px; font-weight: 700; color: var(--vanisha-gold); margin-bottom: 10px;">Vanisha Bakery</h3>
            </div>
            <div class="footer-social">
                <span>Follow us:</span>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-tiktok"></i>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Vanisha Bakery.</p>
            <div class="footer-creators">
                <p>Dibuat oleh: <strong>Muhammad Suhendy</strong>, <strong>Asep Awaludin</strong>, <strong>Amar Abdillah</strong></p>
            </div>
        </div>
    </div>
</footer>

{{-- Cart Overlay --}}
<div id="cartOverlay" class="cart-overlay" onclick="Alpine.store('cart').closeDrawer()"></div>

{{-- Cart Drawer --}}
<div id="cartDrawer" class="cart-drawer" x-data>
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 15px; border-bottom: 2px solid var(--vanisha-red); margin-bottom: 20px;">
        <h3 style="font-size: 20px; font-weight: 700; color: var(--vanisha-red); margin: 0;">
            <i class="fas fa-shopping-cart me-2"></i>Keranjang
        </h3>
        <button onclick="Alpine.store('cart').closeDrawer()" style="background: none; border: none; font-size: 28px; cursor: pointer; color: #999; line-height: 1; padding: 0;">&times;</button>
    </div>

    <div style="flex-grow: 1; overflow-y: auto; margin-bottom: 20px;">
        <template x-for="(item, index) in $store.cart.items" :key="index">
            <div style="padding: 15px 0; border-bottom: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <p style="font-weight: 600; font-size: 15px; margin: 0; flex: 1;" x-text="item.name"></p>
                    <button style="background: var(--vanisha-red); color: white; border: none; border-radius: 4px; padding: 4px 10px; font-size: 11px; cursor: pointer;"
                            @click="$store.cart.removeItem(index)">
                        Hapus
                    </button>
                </div>
                <p style="font-size: 14px; color: var(--vanisha-red); font-weight: 700; margin: 0 0 10px 0;" 
                   x-text="$store.cart.formatRupiah(item.price * item.quantity)"></p>
                
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button @click="$store.cart.decrementItem(index)" style="background: var(--vanisha-red); color: white; border: none; width: 28px; height: 28px; border-radius: 4px; font-weight: 700; cursor: pointer;">&minus;</button>
                    <span style="font-size: 14px; font-weight: 600; min-width: 25px; text-align: center;" x-text="item.quantity">1</span>
                    <button @click="$store.cart.incrementItem(index)" style="background: var(--vanisha-orange); color: white; border: none; width: 28px; height: 28px; border-radius: 4px; font-weight: 700; cursor: pointer;">&plus;</button>
                </div>
            </div>
        </template>
        
        <p x-show="$store.cart.items.length === 0" style="text-align: center; color: #999; font-size: 14px; padding: 40px 20px; margin: 0;">
            Keranjang kosong
        </p>
    </div>

    <div style="border-top: 2px solid var(--vanisha-red); padding-top: 15px; margin-bottom: 15px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="font-size: 18px; font-weight: 700;">Total:</span>
            <span style="font-size: 22px; font-weight: 800; color: var(--vanisha-red);" x-text="$store.cart.formatRupiah($store.cart.total)">Rp 0</span>
        </div>
    </div>

    <a href="{{ route('checkout') }}" 
       x-show="$store.cart.items.length > 0"
       style="width: 100%; padding: 14px; background: var(--vanisha-orange); color: white; border: none; border-radius: 999px; font-size: 15px; font-weight: 700; cursor: pointer; transition: background 0.2s; text-decoration: none; display: block; text-align: center;" 
       onmouseover="this.style.background='#ea580c'" 
       onmouseout="this.style.background='var(--vanisha-orange)'">
        Checkout
    </a>

    <p x-show="$store.cart.items.length === 0" 
       style="text-align: center; color: #999; font-size: 14px; padding: 14px;">
        Keranjang kosong. Tambahkan produk terlebih dahulu.
    </p>
</div>

{{-- Toast Notification --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2001;">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: var(--vanisha-orange) !important; color: white;">
            <strong class="me-auto">
                <i class="fas fa-bread-slice me-2"></i>Vanisha Bakery
            </strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" style="color: #333; font-size: 14px;">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
