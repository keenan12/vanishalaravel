@extends('layouts.app')

@section('breadcrumb')
    Dashboard / <a href="{{ route('admin.users.index') }}">User Management</a> / Tambah User
@endsection

@section('content')
<div class="card">
    <div class="card-header">➕ Tambah User Baru</div>

    <form action="{{ route('admin.users.store') }}" method="POST" style="padding: 20px;">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <!-- ⭐ TAMBAHKAN FIELD ROLE -->
        <div class="form-group" style="display: none;">
            <input type="hidden" name="role" value="admin">
            @error('role') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
