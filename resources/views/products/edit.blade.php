@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a> / 
    <a href="{{ route('admin.products.index') }}">Produk</a> / 
    Edit Produk: {{ $product->name }}
@endsection

@section('content')
<div class="card" style="max-width: 750px; margin: auto; padding: 25px;">
    <div class="card-header" style="font-size: 24px; font-weight: 700; color: #2c3e50; margin: 0 0 25px 0;">
        ✏️ Edit Produk: **{{ $product->name }}**
    </div>

    {{-- Pastikan enctype="multipart/form-data" ada untuk file upload --}}
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Produk <span style="color: #e74c3c;">*</span></label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $product->name) }}" 
                       required
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('name')) border-color: #e74c3c; @endif">
                @error('name')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">SKU (Stock Keeping Unit) <span style="color: #e74c3c;">*</span></label>
                <input type="text" 
                       name="sku" 
                       value="{{ old('sku', $product->sku) }}" 
                       required
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('sku')) border-color: #e74c3c; @endif">
                @error('sku')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Harga (Rp) <span style="color: #e74c3c;">*</span></label>
                <input type="number" 
                       name="price" 
                       step="1000" 
                       min="1000"
                       value="{{ old('price', $product->price) }}" 
                       required
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('price')) border-color: #e74c3c; @endif">
                @error('price')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Stock <span style="color: #e74c3c;">*</span></label>
                <input type="number" 
                       name="stock" 
                       value="{{ old('stock', $product->stock) }}" 
                       min="0"
                       required
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('stock')) border-color: #e74c3c; @endif">
                @error('stock')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Kategori <span style="color: #e74c3c;">*</span></label>
                <select name="category_id" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('category_id')) border-color: #e74c3c; @endif" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Status <span style="color: #e74c3c;">*</span></label>
                <select name="status" required style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('status')) border-color: #e74c3c; @endif">
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>✓ Aktif (Produk tersedia untuk dijual)</option>
                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>✗ Tidak Aktif (Produk disembunyikan)</option>
                </select>
                @error('status')
                    <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr style="margin: 25px 0;">
        <h3 style="font-size: 20px; font-weight: 600; color: #333; margin-bottom: 15px;">🖼️ Gambar Produk</h3>
        
        @if($product->image)
            <div class="current-image-preview" style="margin-bottom: 15px; display: flex; align-items: center; gap: 20px; padding: 10px; border: 1px dashed #ccc;">
                <label style="font-weight: 600; color: #333;">Gambar Saat Ini:</label>
                {{-- Asumsi gambar disimpan di storage yang terhubung ke public/storage --}}
                <img src="{{ asset($product->image) }}" alt="Gambar {{ $product->name }}" style="max-width: 100px; height: auto; border-radius: 4px;">
                <input type="checkbox" name="remove_image" id="remove_image" value="1" style="margin-left: 20px;">
                <label for="remove_image" style="color: #e74c3c;">Hapus Gambar Saat Ini</label>
            </div>
        @endif

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Ganti Gambar Baru</label>
            <input type="file" name="image" 
                   accept="image/*"
                   style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; @if($errors->has('image')) border-color: #e74c3c; @endif">
            <small style="display: block; margin-top: 5px; color: #6c757d; font-size: 14px;">Kosongkan jika tidak ingin mengganti gambar.</small>
            @error('image')
                <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
            @enderror
        </div>
        
        <hr style="margin: 25px 0;">
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Deskripsi (Opsional)</label>
            <textarea name="description" 
                      style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; min-height: 120px; font-family: inherit;">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div style="color: #e74c3c; font-size: 12px; margin-top: 5px;">⚠️ {{ $message }}</div>
            @enderror
        </div>


        <div style="padding: 15px; background-color: #f0f8ff; border-radius: 4px; margin-top: 20px; font-size: 13px; line-height: 1.6;">
            <strong>📋 Info Produk:</strong><br>
            Dibuat: {{ $product->created_at->format('d/m/Y H:i') }}<br>
            Diupdate: {{ $product->updated_at->format('d/m/Y H:i') }}
        </div>

        <div style="display: flex; gap: 10px; margin-top: 25px; justify-content: flex-end;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="padding: 10px 20px; text-decoration: none; background-color: #f0f0f0; border: 1px solid #ccc; color: #333; border-radius: 6px;">↶ Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background: #2ecc71; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">💾 Perbarui Produk</button>
        </div>
    </form>
</div>
@endsection