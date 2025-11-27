@extends('layouts.public')

@section('title', 'Vanisha Bakery | Home')

@section('content')

{{-- HERO --}}
<section id="home"
         style="min-height:75vh; position:relative; color:white; text-align:center;
                display:flex; align-items:center; justify-content:center;
                background-image:url('{{ asset('img/bgroti.jpg') }}');
                background-size:cover; background-position:center; background-attachment: fixed;">
    <div style="position:absolute; inset:0; background:rgba(0,0,0,0.55);"></div>
    <div style="position:relative; max-width:700px; padding:0 16px;">
        <p style="font-size:12px; letter-spacing:0.2em; text-transform:uppercase; margin-bottom:8px;">
            FRESH BREAD &amp; CAKES EVERYDAY
        </p>

        {{-- Teks utama dengan animasi typing --}}
        <h1 style="font-size:30px; line-height:1.3; font-weight:800; margin:0 0 10px;">
            <span id="hero-typing-text"></span>
        </h1>

        {{-- subtitle tetap --}}
        <p style="font-size:14px; margin-bottom:16px;">
            Nikmati roti dan kue segar setiap momen spesial.
        </p>

        <a href="{{ route('menu') }}"
           style="display:inline-block; padding:10px 22px; border-radius:999px;
                  background:#f97316; color:white; font-weight:600; font-size:14px;
                  text-decoration:none; transition:background 0.3s;"
           onmouseover="this.style.backgroundColor='#ea580c'" 
           onmouseout="this.style.backgroundColor='#f97316'">
            Beli Sekarang
        </a>
    </div>
</section>

{{-- KENAPA MEMILIH KAMI --}}
<section style="padding:56px 0; background:white;">
    <div style="max-width:960px; margin:0 auto; padding:0 16px;">
        <h2 style="text-align:center; font-size:28px; font-weight:700; color:#b91c1c; margin-bottom:36px;">
            Kenapa Memilih Kami?
        </h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:24px;">
            <div style="background:white; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.08);
                         padding:24px; text-align:center;">
                {{-- Placeholder Icon --}}
                <img src="{{ asset('img/bread_icon.png') }}" onerror="this.onerror=null; this.src='https://placehold.co/64x64/E7B547/ffffff?text=🍞'" style="height:64px; width:64px; object-fit:contain; margin-bottom:10px;">
                <h3 style="font-size:18px; font-weight:600; margin-bottom:4px;">Bahan Segar</h3>
                <p style="font-size:14px; color:#4b5563;">Dipanggang setiap hari dengan bahan lokal pilihan.</p>
            </div>
            <div style="background:white; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.08);
                         padding:24px; text-align:center;">
                {{-- Placeholder Icon --}}
                <img src="{{ asset('img/love_icon.png') }}" onerror="this.onerror=null; this.src='https://placehold.co/64x64/DC2626/ffffff?text=❤️'" style="height:64px; width:64px; object-fit:contain; margin-bottom:10px;">
                <h3 style="font-size:18px; font-weight:600; margin-bottom:4px;">Dibuat Dengan Cinta</h3>
                <p style="font-size:14px; color:#4b5563;">Resep keluarga yang kami jaga dari generasi ke generasi.</p>
            </div>
            <div style="background:white; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.08);
                         padding:24px; text-align:center;">
                {{-- Placeholder Icon --}}
                <img src="{{ asset('img/delivery_icon.png') }}" onerror="this.onerror=null; this.src='https://placehold.co/64x64/1D4ED8/ffffff?text=🛵'" style="height:64px; width:64px; object-fit:contain; margin-bottom:10px;">
                <h3 style="font-size:18px; font-weight:600; margin-bottom:4px;">Pengiriman Cepat</h3>
                <p style="font-size:14px; color:#4b5563;">Roti sampai ke rumah Anda dalam kondisi terbaik.</p>
            </div>
        </div>
    </div>
</section>

{{-- ABOUT --}}
<section id="about" style="padding:56px 0; background:#fdf7ec;">
    <div style="max-width:900px; margin:0 auto; padding:0 16px;">
        <h2 style="text-align:center; font-size:28px; font-weight:700; color:#b91c1c; margin-bottom:24px;">
            Tentang Vanisha Bakery
        </h2>
        <p style="font-size:15px; line-height:1.8; text-align:justify; color:#374151; margin-bottom:12px;">
            Vanisha Bakery berdiri dengan komitmen menghadirkan roti dan kue yang segar setiap hari.
            Kami menggunakan bahan-bahan berkualitas dan diolah langsung oleh tim baker yang berpengalaman.
        </p>
        <p style="font-size:15px; line-height:1.8; text-align:justify; color:#374151; margin-bottom:12px;">
            Dari roti manis, roti tawar, hingga kue spesial untuk hari penting, kami selalu berusaha
            memberikan rasa terbaik dan tampilan yang menarik.
        </p>
        <p style="font-size:15px; line-height:1.8; text-align:justify; color:#374151;">
            Kami percaya roti bukan hanya makanan, tetapi juga bagian dari momen kebersamaan keluarga.
        </p>
    </div>
</section>

{{-- MENU – menggunakan $products dari controller --}}
@php
    function formatRupiahHome($n) {
        return 'Rp' . number_format($n, 0, ',', '.');
    }
@endphp

<section id="menu" style="padding:56px 0; background:#f3f4f6;">
    <div style="max-width:1120px; margin:0 auto; padding:0 16px;">
        <h2 style="text-align:center; font-size:28px; font-weight:700; color:#b91c1c; margin-bottom:24px;">
            Menu Produk
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:24px;">
            @forelse($products as $p)
                <div style="background:white; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.08);
                             display:flex; flex-direction:column; overflow:hidden; transition:transform 0.2s;"
                             onmouseover="this.style.transform='translateY(-5px)'"
                             onmouseout="this.style.transform='translateY(0)'">
                    
                    {{-- GAMBAR PRODUK (Menggunakan $p->image yang diasumsikan berisi path publik) --}}
                    @if($p->image)
                        <img src="{{ asset($p->image) }}"
                             alt="{{ $p->name }}"
                             style="width:100%; height:150px; object-fit:cover;">
                    @else
                        {{-- Placeholder jika gambar tidak ada --}}
                        <div style="width:100%; height:150px; background-color:#f0f0f0; display:flex; align-items:center; justify-content:center; color:#999; font-size:14px; text-align:center; padding:10px;">
                            No Image
                        </div>
                    @endif
                    {{-- END GAMBAR --}}
                    
                    <div style="padding:16px; display:flex; flex-direction:column; flex:1;">
                        <h3 style="font-size:16px; font-weight:700; margin-bottom:4px;">
                            {{ $p->name }}
                        </h3>
                        <p style="font-size:16px; font-weight:800; color:#b91c1c; margin-bottom:12px;">
                            {{ formatRupiahHome($p->price) }}
                        </p>
                        <button
                            style="margin-top:auto; padding:8px 12px; border-radius:999px; border:none;
                                    background:#f97316; color:white; font-size:14px; font-weight:600;
                                    cursor:pointer; transition:background 0.3s;"
                            onmouseover="this.style.backgroundColor='#ea580c'" 
                            onmouseout="this.style.backgroundColor='#f97316'"
                            @click="$store.cart.addToCart('{{ addslashes($p->name) }}', {{ $p->price }})">
                            <i class="fas fa-cart-plus" style="margin-right:4px;"></i> Beli
                        </button>
                    </div>
                </div>
            @empty
                <p style="grid-column:1/-1; text-align:center; color:#6b7280; font-size:14px;">
                    Belum ada produk yang tersedia.
                </p>
            @endforelse

        </div>
    </div>
</section>

{{-- CONTACT --}}
<section id="contact" style="padding:56px 0; background:#fdf7ec;">
    <div style="max-width:960px; margin:0 auto; padding:0 16px; display:grid;
                grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:24px;">
        <div>
            <h2 style="font-size:24px; font-weight:700; color:#b91c1c; margin-bottom:12px;">
                Hubungi Kami
            </h2>
            <p style="font-size:14px; color:#374151; margin-bottom:8px;">
                <i class="fas fa-map-marker-alt" style="width:20px;"></i> Jl. Kenangan Manis No. 123, Jakarta
            </p>
            <p style="font-size:14px; color:#374151; margin-bottom:8px;">
                <i class="fas fa-phone" style="width:20px;"></i> Telp: (021) 123-4567
            </p>
            <p style="font-size:14px; color:#374151; margin-bottom:8px;">
                <i class="fas fa-envelope" style="width:20px;"></i> Email: halo@vanishabakery.com
            </p>
            <p style="font-size:14px; color:#374151;">
                <i class="fas fa-clock" style="width:20px;"></i> Jam Operasional: Senin – Sabtu, 08.00 – 20.00
            </p>
        </div>

        <div style="background:white; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.08); padding:20px;">
            <h3 style="font-size:18px; font-weight:600; margin-bottom:12px; color:#b91c1c;">
                Kirim Pesan
            </h3>
            <form action="{{ route('contact.send') }}" method="POST" style="display:flex; flex-direction:column; gap:10px;">
                @csrf
                <div>
                    <label for="name" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Nama</label>
                    <input id="name" name="name" type="text" required
                           style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #d1d5db;">
                </div>
                <div>
                    <label for="email" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Email</label>
                    <input id="email" name="email" type="email" required
                           style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #d1d5db;">
                </div>
                <div>
                    <label for="message" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Pesan</label>
                    <textarea id="message" name="message" rows="4" required
                             style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #d1d5db;"></textarea>
                </div>
                <button type="submit"
                        style="margin-top:4px; padding:8px 14px; border-radius:999px; border:none;
                               background:#f97316; color:white; font-size:14px; font-weight:600; cursor:pointer;
                               transition:background 0.3s;"
                        onmouseover="this.style.backgroundColor='#ea580c'" 
                        onmouseout="this.style.backgroundColor='#f97316'">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    // Script untuk efek mengetik (Typing Animation) pada Hero Section
    document.addEventListener('DOMContentLoaded', function() {
        const textElement = document.getElementById('hero-typing-text');
        if (!textElement) return;

        const textToType = "Rasakan kelezatan roti dan kue buatan kami.";
        textElement.textContent = "";
        let i = 0;

        function typeWriter() {
            if (i < textToType.length) {
                textElement.textContent += textToType.charAt(i);
                i++;
                setTimeout(typeWriter, 50); // Kecepatan mengetik: 50ms
            }
        }

        typeWriter();
    });
</script>


@endsection