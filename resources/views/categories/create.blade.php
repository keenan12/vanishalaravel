@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('categories.index') }}">Kategori</a> / Tambah Baru
@endsection

@section('content')
<div class="card">
    <div class="card-header">Tambah Kategori Baru</div>

    <form method="POST" action="{{ route('categories.store') }}" style="padding: 20px;">
        @csrf

        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
