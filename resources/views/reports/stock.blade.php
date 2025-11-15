@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('reports.index') }}">Laporan</a> / Stock
@endsection

@section('content')
<div class="card" style="text-align: center; margin-bottom: 30px;">
    <div style="font-size: 32px; color: #f39c12; margin-bottom: 10px; font-weight: bold;">{{ $totalStock }}</div>
    <div style="font-size: 14px; color: #666;">Total Stock Seluruh Produk</div>
</div>

<div class="card">
    <div class="card-header">Detail Stock Per Produk</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>SKU</th>
                <th>Harga</th>
                <th>Stock Saat Ini</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <strong style="font-size: 16px; @if($product->stock < 10) color: #e74c3c; @elseif($product->stock < 50) color: #f39c12; @else color: #27ae60; @endif">
                            {{ $product->stock }}
                        </strong>
                    </td>
                    <td>
                        @if($product->stock < 10)
                            <span style="background-color: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 3px; font-size: 12px;">Stok Rendah</span>
                        @elseif($product->stock < 50)
                            <span style="background-color: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 3px; font-size: 12px;">Stok Sedang</span>
                        @else
                            <span style="background-color: #d4edda; color: #155724; padding: 4px 8px; border-radius: 3px; font-size: 12px;">Stok Aman</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">Tidak ada produk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
