@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('categories.index') }}">Kategori</a> / Edit
@endsection

@section('content')
<div class="card">
    <div class="card-header">Edit Kategori: {{ $category->name }}</div>

    <form method="POST" action="{{ route('categories.update', $category->id) }}" style="padding: 20px;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" required>
            @error('name')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description">{{ $category->description }}</textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
