@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / Stock
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Riwayat Stock</span>
            <a href="{{ route('stocks.create') }}" class="btn btn-primary">+ Masuk/Keluar Stock</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Alasan</th>
                <th>Tanggal</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $index => $stock)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>
                        <span style="padding: 4px 8px; border-radius: 3px; font-size: 12px;
                            @if($stock->type == 'in') background-color: #d4edda; color: #155724; @else background-color: #f8d7da; color: #721c24; @endif">
                            {{ ucfirst($stock->type) }}
                        </span>
                    </td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->reason }}</td>
                    <td>{{ $stock->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $stock->notes ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #999;">Tidak ada riwayat stock</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
