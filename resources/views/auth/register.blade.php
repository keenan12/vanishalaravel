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

                <!-- Divider -->
                <div style="text-align:center; color:#9ca3af; font-size:13px; margin:8px 0; position:relative;">
                    <span style="background:white; padding:0 12px; position:relative; z-index:1;">atau</span>
                    <div style="position:absolute; top:50%; left:0; right:0; height:1px; background:#e5e7eb; z-index:0;"></div>
                </div>

                <!-- Google Register Button -->
                <a href="{{ route('auth.google') }}" 
                   style="display:flex; align-items:center; justify-content:center; gap:10px; padding:10px 14px; 
                          border-radius:999px; border:1px solid #d1d5db; background:white; color:#374151; 
                          font-size:14px; font-weight:600; text-decoration:none; transition:all 0.3s;"
                   onmouseover="this.style.borderColor='#f97316'; this.style.backgroundColor='#fef7ec';"
                   onmouseout="this.style.borderColor='#d1d5db'; this.style.backgroundColor='white';">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.64 9.20454C17.64 8.56636 17.5827 7.95273 17.4764 7.36364H9V10.845H13.8436C13.635 11.97 13.0009 12.9232 12.0477 13.5614V15.8195H14.9564C16.6582 14.2527 17.64 11.9454 17.64 9.20454Z" fill="#4285F4"/>
                        <path d="M9 18C11.43 18 13.4673 17.1941 14.9564 15.8195L12.0477 13.5614C11.2418 14.1014 10.2109 14.4204 9 14.4204C6.65591 14.4204 4.67182 12.8373 3.96409 10.71H0.957275V13.0418C2.43818 15.9832 5.48182 18 9 18Z" fill="#34A853"/>
                        <path d="M3.96409 10.71C3.78409 10.17 3.68182 9.59318 3.68182 9C3.68182 8.40682 3.78409 7.83 3.96409 7.29V4.95818H0.957275C0.347727 6.17318 0 7.54773 0 9C0 10.4523 0.347727 11.8268 0.957275 13.0418L3.96409 10.71Z" fill="#FBBC05"/>
                        <path d="M9 3.57955C10.3214 3.57955 11.5077 4.03364 12.4405 4.92545L15.0218 2.34409C13.4632 0.891818 11.4259 0 9 0C5.48182 0 2.43818 2.01682 0.957275 4.95818L3.96409 7.29C4.67182 5.16273 6.65591 3.57955 9 3.57955Z" fill="#EA4335"/>
                    </svg>
                    <span>Daftar dengan Google</span>
                </a>

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
