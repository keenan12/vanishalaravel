@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a> / 
    <a href="{{ route('admin.products.index') }}">Produk</a> / 
    Tambah Produk
@endsection

@section('content')
<div class="card p-4"> {{-- Asumsi 'p-4' adalah padding dari class Tailwind/Bootstrap --}}
    <h1 style="font-size: 24px; font-weight: 700; color: #2c3e50; margin: 0 0 25px 0;">➕ Tambah Produk Baru</h1>

    {{-- Pastikan enctype="multipart/form-data" ada untuk file upload --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Produk <span style="color: #f44336;">*</span></label>
                <input type="text" name="name" placeholder="Contoh: Roti Tawar" 
                    value="{{ old('name') }}"
                    class="form-control"
                    style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                    required>
                @error('name') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">SKU <span style="color: #f44336;">*</span></label>
                <input type="text" name="sku" placeholder="Contoh: SKU-ROTI-001" 
                    value="{{ old('sku') }}"
                    class="form-control"
                    style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                    required>
                @error('sku') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Harga (Rp) <span style="color: #f44336;">*</span></label>
                <input type="number" name="price" placeholder="Contoh: 15000" 
                    value="{{ old('price') }}"
                    class="form-control"
                    style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                    required>
                @error('price') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Stock <span style="color: #f44336;">*</span></label>
                <input type="number" name="stock" placeholder="Contoh: 50" 
                    value="{{ old('stock') }}"
                    class="form-control"
                    style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                    required>
                @error('stock') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Kategori <span style="color: #f44336;">*</span></label>
                <select name="category_id" class="form-control" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Status</label>
                <select name="status" class="form-control" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="active" @if(old('status') == 'active') selected @endif>✓ Aktif</option>
                    <option value="inactive" @if(old('status') == 'inactive') selected @endif>✗ Tidak Aktif</option>
                </select>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            {{-- FIELD BARU: Gambar Produk --}}
            <div>
                <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Gambar Produk</label>
                <input type="file" name="image"
                    class="form-control-file"
                    style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px;"
                    accept="image/*"
                    >
                <small class="text-muted" style="display: block; margin-top: 5px; color: #6c757d; font-size: 14px;">Maksimal 2MB (jpg, jpeg, png).</small>
                @error('image') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Deskripsi</label>
            <textarea name="description" placeholder="Masukkan deskripsi produk..." 
                class="form-control"
                style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; min-height: 120px; font-family: inherit;">{{ old('description') }}</textarea>
            @error('description') <span class="text-danger" style="color: #f44336; font-size: 12px;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="padding: 12px 24px; text-decoration: none; border: 1px solid #ccc; border-radius: 6px;">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; background: #667eea; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection