@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('products.index') }}">Produk</a> / Edit
@endsection

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">✏️ Edit Produk: {{ $product->name }}</div>

    <form method="POST" action="{{ route('products.update', $product->id) }}" style="padding: 20px;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Produk <span style="color: #e74c3c;">*</span></label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $product->name) }}" 
                   required
                   style="@if($errors->has('name')) border-color: #e74c3c; @endif">
            @error('name')
                <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>SKU (Stock Keeping Unit) <span style="color: #e74c3c;">*</span></label>
            <input type="text" 
                   name="sku" 
                   value="{{ old('sku', $product->sku) }}" 
                   required
                   style="@if($errors->has('sku')) border-color: #e74c3c; @endif">
            @error('sku')
                <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label>Harga (Rp) <span style="color: #e74c3c;">*</span></label>
                <input type="number" 
                       name="price" 
                       step="1000" 
                       min="1000"
                       value="{{ old('price', $product->price) }}" 
                       required
                       style="@if($errors->has('price')) border-color: #e74c3c; @endif">
                @error('price')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Stock <span style="color: #e74c3c;">*</span></label>
                <input type="number" 
                       name="stock" 
                       value="{{ old('stock', $product->stock) }}" 
                       min="0"
                       required
                       style="@if($errors->has('stock')) border-color: #e74c3c; @endif">
                @error('stock')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi (Opsional)</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Status <span style="color: #e74c3c;">*</span></label>
            <select name="status" required style="@if($errors->has('status')) border-color: #e74c3c; @endif">
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>✓ Aktif (Produk tersedia untuk dijual)</option>
                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif (Produk disembunyikan)</option>
            </select>
            @error('status')
                <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
            @enderror
        </div>

        <!-- Info Tambahan -->
        <div style="padding: 15px; background-color: #f0f8ff; border-radius: 4px; margin-top: 20px; font-size: 13px;">
            <strong>📋 Info Produk:</strong><br>
            Dibuat: {{ $product->created_at->format('d/m/Y H:i') }}<br>
            Diupdate: {{ $product->updated_at->format('d/m/Y H:i') }}
        </div>

        <div style="display: flex; gap: 10px; margin-top: 25px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">💾 Perbarui Produk</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary" style="padding: 10px 20px;">↶ Batal</a>
        </div>
    </form>
</div>
@endsection
