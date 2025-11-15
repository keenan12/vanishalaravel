@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')

    <section class="py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl hero-title font-bold text-center text-vanisha-brown mb-16">Our Story & Testimonials</h1>
            
            <div class="flex flex-wrap lg:flex-nowrap items-center bg-white shadow-xl rounded-2xl overflow-hidden mb-20" x-data="{ visible: false }" x-intersect.once="visible = true">
                <div class="w-full lg:w-1/2 h-96 lg:h-auto bg-cover bg-center" style="background-image: url('{{ asset('images/image_997b4e.png') }}');">
                    </div>
                
                <div class="w-full lg:w-1/2 p-10 lg:p-16" 
                     :class="{ 'opacity-0 translate-x-10': !visible, 'opacity-100 translate-x-0': visible }"
                     class="transition duration-1000 ease-out">
                    <span class="text-vanisha-orange font-semibold mb-2 block">Our Heritage</span>
                    <h2 class="text-4xl hero-title font-bold text-vanisha-brown mb-6">Dipanggang dengan Filosofi</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Vanisha Bakery lahir dari kecintaan yang mendalam terhadap seni *baking*. Kami menggabungkan teknik Eropa klasik dengan cita rasa Indonesia untuk menciptakan produk yang unik dan tak terlupakan.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Setiap resep adalah hasil dari eksplorasi bertahun-tahun dan hanya menggunakan bahan baku premium. Kami bukan sekadar toko roti, kami adalah bagian dari tradisi Anda.
                    </p>
                </div>
            </div>

            <div class="text-center">
                <p class="text-vanisha-orange font-semibold uppercase mb-2">Testimonials</p>
                <h2 class="text-4xl hero-title font-bold text-vanisha-brown mb-12">Apa Kata Pelanggan Kami</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $testimonials = [
                            ['name' => 'Zee', 'quote' => 'Roti terbaik yang pernah saya coba! Sourdough mereka luar biasa dan selalu segar.', 'rating' => '★★★★★'],
                            ['name' => 'Bambang', 'quote' => 'Pelayanannya cepat, kuenya indah, dan rasanya benar-benar premium. Sangat direkomendasikan.', 'rating' => '★★★★★'],
                            ['name' => 'Chandra', 'quote' => 'Saya selalu kembali untuk croissant mereka. Lapisan *butter* yang sempurna dan renyah.', 'rating' => '★★★★★'],
                        ];
                    @endphp

                    @foreach($testimonials as $i => $testi)
                    <div class="p-8 bg-white rounded-lg shadow-md hover-scale" x-data="{ visible: false }" x-intersect.once="visible = true"
                         :class="{ 'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible }"
                         class="transition duration-700 ease-out delay-{{ $i * 150 }}">
                        <p class="text-3xl mb-4 text-vanisha-orange">“</p>
                        <p class="italic text-gray-700 mb-4">"{{ $testi['quote'] }}"</p>
                        <div class="font-bold text-vanisha-brown">{{ $testi['name'] }}</div>
                        <div class="text-yellow-500 mt-2">{{ $testi['rating'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection