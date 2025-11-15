@extends('layouts.app')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Dashboard</a> / <a href="{{ route('reports.index') }}">Laporan</a> / Penjualan
@endsection

@section('content')
<div class="card">
    <div class="card-header">📊 Laporan Penjualan</div>

    <!-- FILTER BULAN -->
    <div style="padding: 15px; background-color: #f9f9f9; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
        <form method="GET" action="{{ route('reports.sales') }}" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end;">
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 5px;">Bulan</label>
                <select name="month" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px;">
                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 5px;">Tahun</label>
                <select name="year" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px;">
                    @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 12px;">Tampilkan</button>
        </form>
    </div>

    <!-- EXPORT BUTTONS -->
    <div style="padding: 15px; background-color: #f0f8ff; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('reports.exportSalesExcel', ['month' => $month, 'year' => $year]) }}" 
           class="btn btn-primary" style="padding: 10px 20px; font-size: 13px;">
           📊 Download Excel
        </a>
        <a href="{{ route('reports.exportSalesPDF', ['month' => $month, 'year' => $year]) }}" 
           class="btn btn-danger" style="padding: 10px 20px; font-size: 13px;">
           📄 Download PDF
        </a>
    </div>

    <!-- INFO STATISTIK -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 20px;">
        <div style="padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; text-align: center;">
            <div style="font-size: 24px; font-weight: bold;">{{ $totalQuantity }}</div>
            <div style="font-size: 12px; margin-top: 5px;">Total Penjualan (pcs)</div>
        </div>
        <div style="padding: 15px; background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%); color: white; border-radius: 8px; text-align: center;">
            <div style="font-size: 24px; font-weight: bold;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div style="font-size: 12px; margin-top: 5px;">Total Revenue</div>
        </div>
    </div>

    <!-- TABEL PENJUALAN -->
    <div style="overflow-x: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px; width: 40px;">No</th>
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px;">Produk</th>
                    <th style="padding: 14px 10px; text-align: left; font-weight: 600; font-size: 12px;">Pembeli</th>
                    <th style="padding: 14px 10px; text-align: center; font-weight: 600; font-size: 12px; width: 70px;">Jumlah</th>
                    <th style="padding: 14px 10px; text-align: right; font-weight: 600; font-size: 12px;">Harga Satuan</th>
                    <th style="padding: 14px 10px; text-align: right; font-weight: 600; font-size: 12px;">Total Harga</th>
                    <th style="padding: 14px 10px; text-align: center; font-weight: 600; font-size: 12px;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $index => $sale)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td style="padding: 12px 10px; font-size: 12px;">{{ $sales->firstItem() + $index }}</td>
                        <td style="padding: 12px 10px; font-size: 12px; font-weight: 500;">{{ $sale->product->name ?? 'N/A' }}</td>
                        <td style="padding: 12px 10px; font-size: 12px;">{{ $sale->customer_name ?? 'Umum' }}</td>
                        <td style="padding: 12px 10px; font-size: 12px; text-align: center;">{{ $sale->quantity }}</td>
                        <td style="padding: 12px 10px; font-size: 12px; text-align: right;">Rp {{ number_format($sale->product->price ?? 0, 0, ',', '.') }}</td>
                        <td style="padding: 12px 10px; font-size: 12px; text-align: right; font-weight: 600; color: #667eea;">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td style="padding: 12px 10px; font-size: 12px; text-align: center;">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 30px; text-align: center; color: #999;">
                            Belum ada data penjualan untuk periode ini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if($sales->hasPages())
        <div style="padding: 15px; border-top: 1px solid #e0e0e0; display: flex; justify-content: center;">
            {{ $sales->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
