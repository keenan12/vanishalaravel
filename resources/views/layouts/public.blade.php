<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vanisha Bakery - @yield('title', 'We Deliver Happiness')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('build/assets/app-*.css') }}"> -->

    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
     @vite('resources/css/app.css') 

    <style>
        /* Menggunakan font yang elegan */
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f3; }
        .hero-title { font-family: 'Playfair Display', serif; }
        .bg-vanisha-brown { background-color: #8c3b2e; }
        .text-vanisha-orange { color: #e98031; }
        .hover-scale:hover { transform: scale(1.05); transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body x-data>

    <header class="bg-vanisha-brown shadow-lg fixed w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-white hero-title">Vanisha</a>
            <nav class="space-x-8 hidden md:flex">
                <a href="{{ route('about') }}" class="text-white hover:text-vanisha-orange transition duration-200">About Us</a>
                <a href="{{ route('menu') }}" class="text-white hover:text-vanisha-orange transition duration-200">Menu</a>
                <a href="#" class="text-white hover:text-vanisha-orange transition duration-200">Testimonials</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-vanisha-orange transition duration-200">Contact</a>
            </nav>
            <a href="#" class="bg-vanisha-orange text-white py-2 px-4 rounded-full font-semibold hidden md:block hover-scale">Sign In</a>
            </div>
    </header>

    <main class="pt-20">
        @yield('content')
    </main>

    <footer class="bg-[#5a261a] text-white py-12 mt-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-vanisha-orange">Gallery</h5>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="w-full h-12 bg-gray-60 rounded-md"></div>
                        <div class="w-full h-12 bg-gray-60 rounded-md"></div>
                        <div class="w-full h-12 bg-gray-60 rounded-md"></div>
                    </div>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-vanisha-orange">About Us</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-vanisha-orange transition">About us</a></li>
                        <li><a href="#" class="hover:text-vanisha-orange transition">Customer Service</a></li>
                        <li><a href="#" class="hover:text-vanisha-orange transition">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-vanisha-orange">Support</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-vanisha-orange transition">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-vanisha-orange transition">Secure Shopping</a></li>
                        <li><a href="#" class="hover:text-vanisha-orange transition">Payment method</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-vanisha-orange">Account Info</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-vanisha-orange transition">Order History</a></li>
                        <li><a href="#" class="hover:text-vanisha-orange transition">My Account</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-vanisha-orange transition">New products</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
                Copyright &copy; 2024 Vanisha Bakery. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>