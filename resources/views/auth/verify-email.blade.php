@extends('layouts.public')

@section('title', 'Verifikasi Email')

@section('content')
<section style="min-height: calc(100vh - 140px); display:flex; align-items:center; justify-content:center; background:#f3f4f6; padding:40px 16px;">
    <div style="max-width: 720px; width:100%;">
        <div style="background:white; border-radius:16px; padding:32px 32px; box-shadow:0 10px 25px rgba(15,23,42,0.08); text-align:center;">
            <h1 style="font-size:28px; font-weight:800; margin-bottom:16px; color:#b91c1c;">
                Verifikasi Email Anda
            </h1>

            <p style="margin-bottom:6px; color:#374151; font-size:15px;">
                Kami telah mengirim link verifikasi ke alamat email Anda.
            </p>
            <p style="margin-bottom:6px; color:#4b5563; font-size:14px;">
                Silakan buka email tersebut dan klik tombol verifikasi sebelum melanjutkan.
            </p>
            <p style="margin-bottom:14px; color:#6b7280; font-size:13px;">
                Jika email tidak terlihat di inbox, coba periksa folder spam atau promosi.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div style="margin-bottom:14px; padding:10px 12px; border-radius:8px; background:#ecfdf3; color:#15803d; font-size:13px; display:inline-block; text-align:left;">
                    Link verifikasi baru sudah dikirim ke email Anda.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" style="margin-top:8px;">
                @csrf
                <button type="submit"
                        style="padding:10px 24px; border-radius:999px; border:none; background:#f97316; color:white; font-weight:600; font-size:14px; cursor:pointer;">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <div style="margin-top:18px;">
                <a href="{{ url('/') }}"
                   style="font-size:13px; color:#6b7280; text-decoration:none;"
                   onmouseover="this.style.color='#f97316'"
                   onmouseout="this.style.color='#6b7280'">
                    Kembali ke beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
