@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')

    <section class="bg-[#a04938] py-16">
        <div class="container mx-auto px-6 text-white">
            <h1 class="text-5xl hero-title font-bold text-center mb-12">Hubungi Kami</h1>

            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                    <div class="bg-vanisha-brown p-8 rounded-xl shadow-2xl h-full">
                        <h2 class="text-3xl font-bold mb-6 text-vanisha-orange">Detail Vanisha</h2>
                        
                        <div class="space-y-6">
                            <p class="flex items-start">
                                <span class="text-xl mr-3">📍</span>
                                <span>Jl. Kenangan Manis No. 123, Bakery City, Jakarta</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-xl mr-3">📞</span>
                                <span>(021) 123-4567</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-xl mr-3">📧</span>
                                <span>halo@vanishabakery.com</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-xl mr-3">🕒</span>
                                <span>Senin - Sabtu: 08:00 - 20:00</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3 px-4">
                    <div class="bg-white p-8 rounded-xl shadow-2xl text-gray-800">
                        
                        <h2 class="text-3xl font-bold mb-6 text-vanisha-brown">Kirim Pesan</h2>
                        
                        @if (session('success'))
                            <div class="bg-green-100 text-green-700 p-4 rounded mb-4 border border-green-300">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 p-4 rounded mb-4 border border-red-300">
                                Pesan gagal dikirim. Mohon periksa kembali input Anda.
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label for="name" class="block font-medium mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-vanisha-orange focus:border-vanisha-orange @error('name') border-red-500 @enderror">
                            </div>

                            <div>
                                <label for="email" class="block font-medium mb-1">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-vanisha-orange focus:border-vanisha-orange @error('email') border-red-500 @enderror">
                            </div>

                            <div>
                                <label for="pesan" class="block font-medium mb-1">Pesan</label>
                                <textarea id="pesan" name="message" rows="5" required
                                          class="w-full p-3 border border-gray-300 rounded-lg focus:ring-vanisha-orange focus:border-vanisha-orange @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-vanisha-orange text-white py-3 px-6 rounded-lg font-bold hover:bg-orange-600 transition duration-300 hover-scale">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection