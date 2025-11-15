@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / 
    <a href="{{ route('products.index') }}">Produk</a> / 
    Tambah Produk
@endsection

@section('content')
<div class="card">
    <h1 style="font-size: 24px; font-weight: 700; color: #2c3e50; margin: 0 0 25px 0;">➕ Tambah Produk Baru</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <!-- Nama Produk -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Produk <span style="color: #f44336;">*</span></label>
                <input type="text" name="name" placeholder="Contoh: Roti Tawar" 
                       value="{{ old('name') }}"
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                       required>
                @error('name') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <!-- SKU -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">SKU <span style="color: #f44336;">*</span></label>
                <input type="text" name="sku" placeholder="Contoh: SKU-ROTI-001" 
                       value="{{ old('sku') }}"
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                       required>
                @error('sku') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <!-- Harga -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Harga (Rp) <span style="color: #f44336;">*</span></label>
                <input type="number" name="price" placeholder="Contoh: 15000" 
                       value="{{ old('price') }}"
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                       required>
                @error('price') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <!-- Stock -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Stock <span style="color: #f44336;">*</span></label>
                <input type="number" name="stock" placeholder="Contoh: 50" 
                       value="{{ old('stock') }}"
                       style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                       required>
                @error('stock') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Kategori <span style="color: #f44336;">*</span></label>
                <select name="category_id" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Status</label>
                <select name="status" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="active" @if(old('status') == 'active') selected @endif>✓ Aktif</option>
                    <option value="inactive" @if(old('status') == 'inactive') selected @endif>✗ Tidak Aktif</option>
                </select>
            </div>
        </div>

        <!-- Deskripsi -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Deskripsi</label>
            <textarea name="description" placeholder="Masukkan deskripsi produk..." 
                      style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; min-height: 120px; font-family: inherit;">{{ old('description') }}</textarea>
            @error('description') <span style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('products.index') }}" class="btn btn-secondary" style="padding: 12px 24px; text-decoration: none;">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; background: #667eea; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
