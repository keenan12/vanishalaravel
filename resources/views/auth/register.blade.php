{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.public')

@section('title', 'Daftar | Vanisha Bakery')

@section('content')
    <section style="min-height:70vh; display:flex; align-items:center; justify-content:center; background:#f3f4f6; padding:32px 16px;">
        <div style="width:100%; max-width:420px; background:white; border-radius:16px;
                    box-shadow:0 10px 25px rgba(0,0,0,0.08); padding:28px 24px;">
            <div style="text-align:center; margin-bottom:20px;">
                <h1 style="font-size:22px; font-weight:700; margin-bottom:4px; color:#6b2b12;">
                    Daftar Akun
                </h1>
                <p style="font-size:13px; color:#6b7280;">
                    Buat akun untuk memudahkan pemesanan roti dan kue.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:12px;">
                @csrf

                <div>
                    <label for="name" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                           style="width:100%; padding:9px 11px; border-radius:8px; border:1px solid #d1d5db; font-size:14px;">
                    @error('name')
                        <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           style="width:100%; padding:9px 11px; border-radius:8px; border:1px solid #d1d5db; font-size:14px;">
                    @error('email')
                        <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">Password</label>
                    <input id="password" name="password" type="password" required
                           style="width:100%; padding:9px 11px; border-radius:8px; border:1px solid #d1d5db; font-size:14px;">
                    @error('password')
                        <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" style="display:block; font-size:13px; font-weight:600; margin-bottom:4px;">
                        Konfirmasi Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           style="width:100%; padding:9px 11px; border-radius:8px; border:1px solid #d1d5db; font-size:14px;">
                </div>

                <button type="submit"
                        style="margin-top:8px; padding:10px 14px; border-radius:999px; border:none;
                               background:#f97316; color:white; font-size:14px; font-weight:600; cursor:pointer; width:100%;">
                    Daftar
                </button>

                <div style="text-align:center; margin-top:10px; font-size:13px; color:#6b7280;">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" style="color:#f97316; font-weight:600; text-decoration:none;">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
