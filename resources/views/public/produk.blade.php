@extends('layouts.public')

@section('title', 'Menu Produk')

@section('content')

    <div class="container mx-auto px-6 py-16">
        <h1 class="text-5xl hero-title font-bold text-center text-vanisha-brown mb-12">Menu Populer Kami</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale transition duration-300 group">
                <div class="relative overflow-hidden h-48">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" 
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black opacity-10 group-hover:opacity-0 transition duration-500"></div>
                </div>

                <div class="p-5 text-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $product['name'] }}</h3>
                    <div class="text-yellow-500 mb-3">{{ $product['rating'] }}</div>
                    <p class="text-2xl font-bold text-vanisha-orange mb-4">
                        Rp{{ number_format($product['price'], 0, ',', '.') }}
                    </p>
                    <button class="w-full bg-vanisha-brown text-white py-2 rounded-full font-medium hover:bg-[#a04938] transition duration-300">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
            @empty
                <div class="col-span-4 text-center py-10 text-gray-500">Belum ada produk saat ini.</div>
            @endforelse
        </div>
    </div>

@endsection