@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('stocks.index') }}">Stock</a> / Tambah
@endsection

@section('content')
<div class="card">
    <div class="card-header">Masuk/Keluar Stock</div>

    <form method="POST" action="{{ route('stocks.store') }}" style="padding: 20px;">
        @csrf

        <div class="form-group">
            <label>Pilih Produk</label>
            <select name="product_id" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                @endforeach
            </select>
            @error('product_id')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Tipe</label>
            <select name="type" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="in">Masuk (Penambahan)</option>
                <option value="out">Keluar (Pengurangan)</option>
            </select>
            @error('type')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="quantity" min="1" required>
            @error('quantity')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Alasan</label>
            <input type="text" name="reason" placeholder="Contoh: Penjualan, Restocking, dll" required>
            @error('reason')<span style="color: #e74c3c; font-size: 12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Catatan Tambahan</label>
            <textarea name="notes" placeholder="Opsional"></textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
