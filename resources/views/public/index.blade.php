@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

    <section class="relative h-[600px] bg-cover bg-center flex items-center justify-center" 
        style="background-image: url('{{ asset('images/image_9978a4.jpg') }}');">
        
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <div class="relative z-10 text-center text-white p-6">
            <div x-data="{ loaded: false }" x-init="setTimeout(() => { loaded = true }, 100)"
                 :class="{ 'opacity-0 translate-y-4': !loaded, 'opacity-100 translate-y-0': loaded }"
                 class="transition duration-1000 ease-out">
                
                <h1 class="hero-title text-6xl md:text-8xl font-bold mb-4">
                    Dengan Varian Rasa Berbeda
                </h1>
                <p class="text-xl md:text-2xl mb-8 font-light">
                    Rasakan kelezatan surga dari roti dan kue artisan kami.
                </p>
                <a href="{{ route('menu') }}" 
                   class="bg-vanisha-orange text-white py-3 px-8 rounded-full text-lg font-semibold hover:bg-orange-600 transition duration-300 hover-scale shadow-lg">
                    Lihat Menu Kami
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-[#fcf5e7]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl hero-title font-bold text-vanisha-brown mb-12">Kenapa Memilih Kami?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="p-6 bg-white rounded-xl shadow-xl hover-scale">
                    <div class="text-5xl text-vanisha-orange mb-4">🥐</div>
                    <h3 class="text-xl font-semibold mb-2">Bahan Segar</h3>
                    <p class="text-gray-600">Dipanggang setiap hari dengan bahan-bahan lokal terbaik.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-xl hover-scale">
                    <div class="text-5xl text-vanisha-orange mb-4">💖</div>
                    <h3 class="text-xl font-semibold mb-2">Dibuat Dengan Cinta</h3>
                    <p class="text-gray-600">Resep tradisional yang diwariskan dari generasi ke generasi.</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-xl hover-scale">
                    <div class="text-5xl text-vanisha-orange mb-4">🚚</div>
                    <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Siap antar ke pintu Anda dalam kondisi terbaik.</p>
                </div>
            </div>
        </div>
    </section>

@endsection