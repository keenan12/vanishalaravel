@extends('layouts.app')

@section('content')
<div style="padding: 20px; max-width: 600px;">
    <div style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <h2 style="color: #333; margin-top: 0;">➕ Tambah Penjualan Baru</h2>

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Produk</label>
                <select name="product_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - Rp {{ number_format($product->price ?? 0, 0) }}</option>
                    @endforeach
                </select>
                @error('product_id') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Nama Pembeli</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Masukkan nama pembeli (optional)" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; box-sizing: border-box;">
                @error('customer_name') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Jumlah (Qty)</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; box-sizing: border-box;">
                @error('quantity') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Total Harga (Rp)</label>
                <input type="number" name="total_price" value="{{ old('total_price') }}" step="0.01" min="0" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; box-sizing: border-box;">
                @error('total_price') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Status</label>
                <select name="status" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="pending">⏳ Pending</option>
                    <option value="completed">✓ Selesai</option>
                    <option value="cancelled">✕ Dibatalkan</option>
                </select>
                @error('status') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #667eea; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; flex: 1;">💾 Simpan</button>
                <a href="{{ route('sales.index') }}" style="background: #95a5a6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; text-align: center; font-weight: bold; flex: 1;">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
