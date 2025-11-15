@extends('layouts.app')

@section('breadcrumb')
    Dashboard / <a href="{{ route('users.index') }}">User Management</a> / Edit User
@endsection

@section('content')
<div class="card">
    <div class="card-header">✏️ Edit User</div>

    <form action="{{ route('users.update', $user) }}" method="POST" style="padding: 20px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
            @error('email') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <!-- ⭐ TAMBAHKAN FIELD ROLE -->
        <div class="form-group">
            <label>Role</label>
            <select name="role" required>
                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer (Pelanggan)</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password">
            @error('password') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">💾 Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
