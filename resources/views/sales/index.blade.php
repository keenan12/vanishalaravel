@extends('layouts.app')

@section('content')
<div style="padding: 20px;">
    <div style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <!-- HEADER -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #667eea; padding-bottom: 15px;">
            <h2 style="margin: 0; color: #333;">📊 Data Penjualan</h2>
            <a href="{{ route('admin.sales.create') }}" style="background: #667eea; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">+ Tambah Penjualan</a>
        </div>

        <!-- MESSAGE -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                 {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        @if(count($sales) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left; color: #333;">No</th>
                            <th style="padding: 12px; text-align: left; color: #333;">Produk</th>
                            <th style="padding: 12px; text-align: left; color: #333;">Pembeli</th>
                            <th style="padding: 12px; text-align: center; color: #333;">Qty</th>
                            <th style="padding: 12px; text-align: right; color: #333;">Total</th>
                            <th style="padding: 12px; text-align: center; color: #333;">Status</th>
                            <th style="padding: 12px; text-align: center; color: #333;">Tanggal</th>
                            <th style="padding: 12px; text-align: center; color: #333;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr style="border-bottom: 1px solid #dee2e6; hover-color: #f5f5f5;">
                                <td style="padding: 12px;">{{ $sales->firstItem() + $loop->index }}</td>
                                <td style="padding: 12px;">{{ $sale->product->name ?? '-' }}</td>
                                <td style="padding: 12px;">{{ $sale->buyer_name ?? $sale->customer_name ?? 'Umum' }}</td>
                                <td style="padding: 12px; text-align: center;">{{ $sale->quantity }}</td>
                                <td style="padding: 12px; text-align: right; font-weight: bold;">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                                <td style="padding: 12px; text-align: center;">
                                    @if($sale->status == 'completed')
                                        <span style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">✓ Selesai</span>
                                    @elseif($sale->status == 'pending')
                                        <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">⏳ Pending</span>
                                    @else
                                        <span style="background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">✕ Batal</span>
                                    @endif
                                </td>
                                <td style="padding: 12px; text-align: center; font-size: 12px;">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                <td style="padding: 12px; text-align: center;">
                                    <a href="{{ route('admin.sales.edit', $sale->id) }}" style="background: #667eea; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 5px; display: inline-block;">Edit</a>
                                    <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #e74c3c; color: white; padding: 6px 12px; border-radius: 4px; border: none; font-size: 12px; cursor: pointer;" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div style="margin-top: 20px;">
                {{ $sales->links('vendor.pagination.custom') }}
            </div>
        @else
            <div style="text-align: center; padding: 40px; color: #999;">
                <p style="font-size: 16px;">📭 Belum ada data penjualan</p>
                <a href="{{ route('admin.sales.create') }}" style="color: #667eea; text-decoration: none;">Tambah penjualan pertama →</a>
            </div>
        @endif

    </div>
</div>

@endsection
