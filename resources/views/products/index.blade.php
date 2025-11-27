@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / Produk
@endsection

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <h1 style="font-size: 24px; font-weight: 700; color: #2c3e50; margin: 0;">📦 Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="padding: 12px 24px; font-size: 14px; border-radius: 8px; background-color: #667eea; color: white; text-decoration: none;">+ Tambah Produk</a>
    </div>

    <div style="padding: 20px; background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%); border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #667eea;">
        <form method="GET" action="{{ route('admin.products.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; align-items: flex-end;">
            
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #555;">🔍 Cari Produk</label>
                <input type="text" name="search" placeholder="Nama atau SKU..." 
                        value="{{ request('search') }}" 
                        style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; font-size: 13px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #555;">Status</label>
                <select name="status" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; font-size: 13px;">
                    <option value="">-- Semua --</option>
                    <option value="active" @if(request('status') == 'active') selected @endif>✓ Aktif</option>
                    <option value="inactive" @if(request('status') == 'inactive') selected @endif>✗ Tidak Aktif</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #555;">Kategori</label>
                <select name="category_id" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; font-size: 13px;">
                    <option value="">-- Semua Kategori --</option>
                    {{-- Asumsi variabel $categories tersedia dari controller --}}
                    @foreach($categories as $category) 
                        <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #555;">Urutkan</label>
                <select name="sort" style="width: 100%; padding: 10px 12px; border: 2px solid #ddd; border-radius: 6px; font-size: 13px;">
                    <option value="id" @if(request('sort') == 'id') selected @endif>Terbaru</option>
                    <option value="name" @if(request('sort') == 'name') selected @endif>Nama A-Z</option>
                    <option value="price" @if(request('sort') == 'price') selected @endif>Harga</option>
                    <option value="stock" @if(request('sort') == 'stock') selected @endif>Stock</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 10px 16px; font-size: 13px; background-color: #667eea; color: white; border: none; border-radius: 6px; cursor: pointer;">Cari</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="flex: 1; padding: 10px 16px; font-size: 13px; background-color: #ccc; color: #333; border-radius: 6px; text-align: center; text-decoration: none;">Reset</a>
            </div>
        </form>

        @if(request('search') || request('status') || request('category_id'))
            <div style="margin-top: 15px; padding: 12px 15px; background-color: #e8f4f8; border-radius: 6px; font-size: 12px; color: #0c5460; border-left: 3px solid #0c5460;">
                <strong>📋 Filter Aktif:</strong>
                @if(request('search'))
                    Cari: <strong>"{{ request('search') }}"</strong>
                @endif
                @if(request('status'))
                    | Status: <strong>{{ ucfirst(request('status')) }}</strong>
                @endif
                @if(request('category_id'))
                    | Kategori: <strong>{{ $categories->find(request('category_id'))->name ?? 'Unknown' }}</strong>
                @endif
                | <a href="{{ route('admin.products.index') }}" style="color: #0c5460; font-weight: bold; text-decoration: none;">Hapus Filter</a>
            </div>
        @endif
    </div>

    <div style="overflow-x: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px; width: 40px;">No</th>
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px; width: 80px;">Gambar</th> {{-- NEW COLUMN --}}
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px; width: 25%">Produk</th>
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px; width: 80px;">SKU</th>
                    <th style="padding: 14px 10px; text-align: right; font-weight: 600; font-size: 12px; width: 100px;">Harga</th>
                    <th style="padding: 14px 10px; text-align: center; font-weight: 600; font-size: 12px; width: 60px;">Stock</th>
                    <th style="padding: 14px 10px; text-align: center; font-weight: 600; font-size: 12px; width: 80px;">Status</th>
                    <th style="padding: 14px 10px; text-align: center; font-weight: 600; font-size: 12px; width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr style="border-bottom: 1px solid #f0f0f0; transition: background-color 0.2s;">
                        <td style="padding: 12px 10px; font-size: 12px; font-weight: 500;">{{ $products->firstItem() + $index }}</td>
                        
                        {{-- NEW DATA CELL: Gambar Produk --}}
                        <td style="padding: 8px 10px; text-align: center;">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                            @else
                                <span style="font-size: 10px; color: #999;">No Image</span>
                            @endif
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 12px;">
                            <div style="font-weight: 600; color: #2c3e50;">{{ $product->name }}</div>
                            <div style="font-size: 10px; color: #7f8c8d; margin-top: 2px;">Kategori: {{ $product->category->name ?? 'N/A' }}</div>
                            @if($product->description)
                                <div style="font-size: 10px; color: #999; margin-top: 2px;">{{ Str::limit($product->description, 35) }}</div>
                            @endif
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 11px;">
                            <code style="background-color: #f0f0f0; padding: 3px 6px; border-radius: 3px;">{{ $product->sku }}</code>
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 12px; text-align: right; font-weight: 600; color: #667eea;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 12px; text-align: center;">
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 600;
                                @if($product->stock < 20) 
                                     background-color: #f8d7da; color: #721c24;
                                @elseif($product->stock < 50) 
                                     background-color: #fff3cd; color: #856404;
                                @else 
                                     background-color: #d4edda; color: #155724;
                                @endif">
                                {{ $product->stock }}
                            </span>
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 12px; text-align: center;">
                            @if($product->status == 'active')
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 10px; background-color: #d4edda; color: #155724; font-weight: 600;">✓ Aktif</span>
                            @else
                                <span style="display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 10px; background-color: #f8d7da; color: #721c24; font-weight: 600;">✗ Tidak</span>
                            @endif
                        </td>
                        
                        <td style="padding: 12px 10px; font-size: 11px; text-align: center;">
                            <div style="display: flex; gap: 4px; justify-content: center;">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="btn btn-primary" 
                                   style="padding: 5px 10px; font-size: 11px; background-color: #667eea; color: white; border-radius: 4px; text-decoration: none;">Edit</a>
                                <form method="POST" 
                                      action="{{ route('admin.products.destroy', $product->id) }}" 
                                      style="display: inline;" 
                                      onsubmit="return confirm('Hapus {{ $product->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 11px; background-color: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 30px; text-align: center; color: #999;">
                            <div style="font-size: 14px; margin-bottom: 8px;">📦 Tidak ada data</div>
                            @if(request('search') || request('status') || request('category_id'))
                                <div style="font-size: 12px;">Ubah filter pencarian atau <a href="{{ route('admin.products.index') }}" style="color: #667eea;">Reset Filter</a></div>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div style="padding: 15px; border-top: 1px solid #e0e0e0; display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
            {{-- Menggunakan `withQueryString()` untuk mempertahankan parameter filter/sort saat berpindah halaman --}}
            {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }} 
        </div>
    @endif

    <div style="padding: 12px 15px; background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%); border-top: 1px solid #e0e0e0; font-size: 11px; color: #666; border-radius: 0 0 10px 10px;">
        <strong>📊</strong> Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari Total {{ $products->total() }} produk. | Halaman: {{ $products->currentPage() }}/{{ $products->lastPage() }}
    </div>
</div>

@endsection