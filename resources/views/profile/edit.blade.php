@extends('layouts.app')

@section('breadcrumb')
    Edit Profil
@endsection

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .profile-page {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        min-height: calc(100vh - 120px);
        padding: 40px 20px;
        margin: -30px -40px;
    }

    @keyframes slideDown {
        from {
            transform: translateX(-50%) translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideUp {
        to {
            transform: translateX(-50%) translateY(-100%);
            opacity: 0;
        }
    }

    .profile-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .hero-glass {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 30px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 50px;
        margin-bottom: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hero-glass::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
        animation: float 15s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(-30px, 30px) rotate(180deg); }
    }

    .hero-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 35px;
    }

    .hero-avatar-ring {
        position: relative;
        width: 140px;
        height: 140px;
        flex-shrink: 0;
    }

    .hero-avatar-ring::before {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 50%;
        background: linear-gradient(45deg, #fff, transparent, #fff);
        animation: spin 3s linear infinite;
        z-index: 0;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .hero-avatar {
        position: relative;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-text {
        color: white;
    }

    .hero-text h1 {
        font-size: 42px;
        font-weight: 800;
        margin: 0 0 12px 0;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .hero-text p {
        font-size: 18px;
        opacity: 0.95;
        margin: 0;
        font-weight: 500;
    }

    .modern-grid {
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 35px;
        margin-bottom: 35px;
    }

    .neuro-card {
        background: #ffffff;
        border-radius: 25px;
        padding: 40px;
        box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.1), -20px -20px 60px rgba(255, 255, 255, 0.8);
    }

    .card-title {
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 30px;
        color: #2c3e50;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .avatar-display {
        position: relative;
        width: 240px;
        height: 240px;
        margin: 0 auto 35px;
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .avatar-display:hover {
        transform: scale(1.08);
    }

    .avatar-display::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
        animation: spin 4s linear infinite;
        z-index: 0;
    }

    .avatar-inner {
        position: relative;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid #fff;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        z-index: 1;
    }

    .avatar-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-hover-text {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 25px;
        color: white;
        font-weight: 700;
        font-size: 15px;
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 50%;
        z-index: 2;
    }

    .avatar-display:hover .avatar-hover-text {
        opacity: 1;
    }

    .modern-btn {
        width: 100%;
        padding: 16px;
        border-radius: 15px;
        border: none;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        margin-bottom: 15px;
    }

    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
    }

    .btn-danger-outline {
        background: white;
        color: #e74c3c;
        border: 2px solid #e74c3c;
        margin-top: 15px;
    }

    .btn-danger-outline:hover {
        background: #e74c3c;
        color: white;
        transform: translateY(-3px);
    }

    .file-info {
        text-align: center;
        font-size: 13px;
        color: #7f8c8d;
        margin-top: -5px;
    }

    .form-modern {
        background: #ffffff;
        border-radius: 25px;
        padding: 45px;
        box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.1), -20px -20px 60px rgba(255, 255, 255, 0.8);
    }

    .section-header {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 25px;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 20px;
        border-bottom: 3px solid #f1f3f5;
    }

    .input-group {
        margin-bottom: 25px;
    }

    .input-label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .input-box {
        position: relative;
    }

    .input-modern {
        width: 100%;
        padding: 16px 20px 16px 55px;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 15px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .input-modern:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        opacity: 0.6;
    }

    .toggle-pass {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
        opacity: 0.5;
        transition: opacity 0.2s;
        padding: 5px;
    }

    .toggle-pass:hover {
        opacity: 1;
    }

    .pass-strength {
        margin-top: 12px;
        display: none;
    }

    .strength-bars {
        display: flex;
        gap: 6px;
        height: 8px;
        margin-bottom: 10px;
    }

    .strength-bar {
        flex: 1;
        background: #e9ecef;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .strength-bar.active {
        animation: fillBar 0.5s ease-out;
    }

    @keyframes fillBar {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    .strength-label {
        font-size: 13px;
        font-weight: 700;
    }

    .help-text {
        font-size: 12px;
        color: #999;
        margin-top: 6px;
        font-style: italic;
    }

    .divider-line {
        height: 3px;
        background: linear-gradient(90deg, transparent, #e9ecef, transparent);
        margin: 40px 0;
        border: none;
    }

    .action-row {
        display: flex;
        gap: 18px;
        margin-top: 40px;
    }

    .btn-save-modern {
        flex: 1;
        padding: 18px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 15px;
        font-weight: 800;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.35);
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }

    .btn-save-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 45px rgba(102, 126, 234, 0.45);
    }

    .btn-cancel-modern {
        padding: 18px 35px;
        background: #f8f9fa;
        color: #495057;
        border: 2px solid #dee2e6;
        border-radius: 15px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        font-family: 'Inter', sans-serif;
    }

    .btn-cancel-modern:hover {
        background: white;
        border-color: #adb5bd;
        transform: translateY(-2px);
    }

    .danger-modern {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.05) 0%, rgba(192, 57, 43, 0.05) 100%);
        border-radius: 25px;
        padding: 45px;
        border: 3px solid #e74c3c;
        box-shadow: 0 15px 50px rgba(231, 76, 60, 0.15);
        position: relative;
        overflow: hidden;
    }

    .danger-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(231, 76, 60, 0.1) 0%, transparent 70%);
        animation: float 15s infinite ease-in-out;
    }

    .danger-content {
        position: relative;
        z-index: 1;
    }

    .danger-modern h3 {
        font-size: 26px;
        font-weight: 800;
        color: #e74c3c;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .danger-modern p {
        color: #721c24;
        margin-bottom: 25px;
        line-height: 1.7;
        font-weight: 500;
        font-size: 15px;
    }

    .danger-form {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        padding: 25px;
        border-radius: 15px;
        border: 2px dashed #e74c3c;
    }

    .danger-password-group {
        margin-bottom: 20px;
    }

    .danger-label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .danger-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .danger-input:focus {
        border-color: #e74c3c;
        outline: none;
        box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
    }

    .btn-delete-modern {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        padding: 16px 32px;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 12px 35px rgba(231, 76, 60, 0.35);
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
        width: 100%;
    }

    .btn-delete-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 45px rgba(231, 76, 60, 0.45);
    }

    @media (max-width: 1024px) {
        .modern-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .profile-page {
            padding: 20px 10px;
        }

        .hero-glass {
            padding: 30px 20px;
        }

        .hero-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<!-- SUCCESS ALERT NOTIFICATION -->
@if(session('success'))
    <div style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); color: #155724; padding: 16px 32px; border-radius: 12px; font-weight: 700; border: 2px solid #28a745; box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25); animation: slideDown 0.5s ease-out; z-index: 9999; max-width: 500px; display: flex; align-items: center; gap: 12px;" id="successAlert">
        <span style="font-size: 24px;">✅</span>
        <span>{{ session('success') }}</span>
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('successAlert');
            if(el) {
                el.style.animation = 'slideUp 0.5s ease-out forwards';
                setTimeout(() => el.remove(), 500);
            }
        }, 5000);
    </script>
@endif

<!-- ERROR ALERT NOTIFICATION -->
@if($errors->any())
    <div style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); color: #721c24; padding: 16px 32px; border-radius: 12px; font-weight: 700; border: 2px solid #e74c3c; box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25); animation: slideDown 0.5s ease-out; z-index: 9999; max-width: 500px; display: flex; align-items: center; gap: 12px;" id="errorAlert">
        <span style="font-size: 24px;">❌</span>
        <span>{{ $errors->first() }}</span>
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('errorAlert');
            if(el) {
                el.style.animation = 'slideUp 0.5s ease-out forwards';
                setTimeout(() => el.remove(), 500);
            }
        }, 5000);
    </script>
@endif

<div class="profile-page">
    <div class="profile-wrapper">
        
        <!-- GLASSMORPHISM HERO -->
        <div class="hero-glass">
            <div class="hero-content">
                <div class="hero-avatar-ring">
                    <div class="hero-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" id="heroAvatarPreview">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" id="heroAvatarPreview">
                        @endif
                    </div>
                </div>
                <div class="hero-text">
                    <h1>✨ Edit Profil</h1>
                    <p>Perbarui informasi akun Anda dengan mudah</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PATCH')

            <div class="modern-grid">
                
                <!-- NEUMORPHIC AVATAR CARD -->
                <div class="neuro-card">
                    <h3 class="card-title">
                        <span style="font-size: 28px;">📸</span>
                        <span>Foto Profil</span>
                    </h3>
                    
                    <div class="avatar-display" onclick="document.getElementById('avatarInput').click()">
                        <div class="avatar-inner">
                            @if(Auth::user()->avatar)
                                <img id="avatarPreview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Preview">
                            @else
                                <img id="avatarPreview" src="{{ asset('images/default-avatar.png') }}" alt="Preview">
                            @endif
                            <div class="avatar-hover-text">📷 Klik untuk Ubah</div>
                        </div>
                    </div>

                    <input type="file" name="avatar" id="avatarInput" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" style="display: none;">
                    
                    <button type="button" onclick="document.getElementById('avatarInput').click()" class="modern-btn btn-gradient">
                        📷 Pilih Foto Baru
                    </button>
                    
                    <p class="file-info">JPG, PNG, GIF, WEBP • Maksimal 4MB</p>
                    
                    @if(Auth::user()->avatar)
                        <button type="button" class="modern-btn btn-danger-outline" onclick="removeAvatar()">
                            🗑️ Hapus Foto
                        </button>
                        <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                    @endif
                </div>

                <!-- MODERN FORM CARD -->
                <div class="form-modern">
                    <div class="section-header">
                        <span style="font-size: 28px;">👤</span>
                        <span>Informasi Akun</span>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Nama Lengkap</label>
                        <div class="input-box">
                            <span class="input-icon">👤</span>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="input-modern" required placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <span class="help-text" style="color: #e74c3c;">❌ {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label class="input-label">Alamat Email</label>
                        <div class="input-box">
                            <span class="input-icon">📧</span>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="input-modern" required placeholder="email@example.com">
                        </div>
                        @error('email')
                            <span class="help-text" style="color: #e74c3c;">❌ {{ $message }}</span>
                        @enderror
                    </div>

                    <hr class="divider-line">

                    <div class="section-header">
                        <span style="font-size: 28px;">🔒</span>
                        <span>Keamanan Password</span>
                    </div>

                    <p class="help-text" style="color: #666; margin-bottom: 20px;">Biarkan kosong jika Anda tidak ingin mengubah password</p>

                    <div class="input-group">
                        <label class="input-label">Password Saat Ini</label>
                        <div class="input-box">
                            <span class="input-icon">🔑</span>
                            <input type="password" name="current_password" id="currentPass" class="input-modern" placeholder="Masukkan password lama">
                            <button type="button" class="toggle-pass" onclick="togglePass('currentPass')">👁️</button>
                        </div>
                        @error('current_password')
                            <span class="help-text" style="color: #e74c3c;">❌ {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label class="input-label">Password Baru</label>
                        <div class="input-box">
                            <span class="input-icon">🔐</span>
                            <input type="password" name="password" id="newPass" class="input-modern" placeholder="Buat password baru" onkeyup="checkStrength()">
                            <button type="button" class="toggle-pass" onclick="togglePass('newPass')">👁️</button>
                        </div>
                        <div class="pass-strength" id="strength">
                            <div class="strength-bars">
                                <div class="strength-bar" id="bar1"></div>
                                <div class="strength-bar" id="bar2"></div>
                                <div class="strength-bar" id="bar3"></div>
                                <div class="strength-bar" id="bar4"></div>
                            </div>
                            <span class="strength-label" id="strengthText"></span>
                        </div>
                        @error('password')
                            <span class="help-text" style="color: #e74c3c;">❌ {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label class="input-label">Konfirmasi Password Baru</label>
                        <div class="input-box">
                            <span class="input-icon">✅</span>
                            <input type="password" name="password_confirmation" id="confirmPass" class="input-modern" placeholder="Ketik ulang password">
                            <button type="button" class="toggle-pass" onclick="togglePass('confirmPass')">👁️</button>
                        </div>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="btn-save-modern">💾 Simpan Perubahan</button>
                        <a href="{{ route('dashboard') }}" class="btn-cancel-modern">❌ Batal</a>
                    </div>
                </div>
            </div>
        </form>

        <!-- DANGER ZONE MODERN -->
        <div class="danger-modern">
            <div class="danger-content">
                <h3>
                    <span style="font-size: 28px;">⚠️</span>
                    <span>Danger Zone - Hapus Akun</span>
                </h3>
                <p>Menghapus akun akan menghapus <strong>SEMUA DATA</strong> Anda secara permanen dari sistem. Tindakan ini <strong>TIDAK DAPAT DIBATALKAN</strong>. Pastikan Anda benar-benar yakin sebelum melanjutkan.</p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirmDelete()" class="danger-form">
                    @csrf
                    @method('DELETE')
                    
                    <div class="danger-password-group">
                        <label class="danger-label">Masukkan Password untuk Konfirmasi Penghapusan</label>
                        <input type="password" name="password" class="danger-input" placeholder="Masukkan password Anda" required>
                        @error('password')
                            <span class="help-text" style="color: #e74c3c; display: block; margin-top: 8px;">❌ {{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn-delete-modern">🗑️ Hapus Akun Permanen</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    // Avatar Upload Handler
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 4 * 1024 * 1024) {
            alert('❌ File terlalu besar! Maksimal 4MB');
            this.value = '';
            return;
        }

        if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'].includes(file.type)) {
            alert('❌ Format hanya JPG/PNG/GIF/WEBP');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('avatarPreview').src = e.target.result;
            document.getElementById('heroAvatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    // Remove Avatar
    function removeAvatar() {
        if (confirm('Yakin hapus foto profil?')) {
            document.getElementById('removeAvatarInput').value = '1';
            document.getElementById('profileForm').submit();
        }
    }

    // Toggle Password
    function togglePass(id) {
        const input = document.getElementById(id);
        const btn = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁️';
        }
    }

    // Check Password Strength
    function checkStrength() {
        const pass = document.getElementById('newPass').value;
        const bars = ['bar1', 'bar2', 'bar3', 'bar4'].map(id => document.getElementById(id));
        const text = document.getElementById('strengthText');
        const container = document.getElementById('strength');

        if (!pass) {
            container.style.display = 'none';
            return;
        }

        container.style.display = 'block';

        let score = 0;
        if (pass.length >= 8) score++;
        if (pass.length >= 12) score++;
        if (pass.match(/[a-z]/) && pass.match(/[A-Z]/)) score++;
        if (pass.match(/\d/)) score++;
        if (pass.match(/[^a-zA-Z\d]/)) score++;

        const levels = [
            { score: 1, color: '#e74c3c', text: '❌ Sangat Lemah' },
            { score: 2, color: '#e67e22', text: '⚠️ Lemah' },
            { score: 3, color: '#f39c12', text: '⚡ Sedang' },
            { score: 4, color: '#3498db', text: '✅ Kuat' },
            { score: 5, color: '#27ae60', text: '✅✅ Sangat Kuat' }
        ];

        let level = levels[Math.min(score - 1, 4)] || levels[0];

        bars.forEach((bar, i) => {
            if (i < score) {
                bar.style.background = level.color;
                bar.classList.add('active');
            } else {
                bar.style.background = '#e9ecef';
                bar.classList.remove('active');
            }
        });

        text.textContent = level.text;
        text.style.color = level.color;
    }

    // Confirm Delete Akun
    function confirmDelete() {
        return confirm('⚠️ PERINGATAN!\n\n🚨 Yakin ingin HAPUS AKUN?\n\nSemua data akan HILANG PERMANEN!\n\nTindakan ini TIDAK BISA DIBATALKAN!');
    }
</script>

@endsection
