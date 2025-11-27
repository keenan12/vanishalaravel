@extends('layouts.app')

@section('breadcrumb')
    📋 Laporan Penjualan
@endsection

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .report-container {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: calc(100vh - 200px);
        padding: 30px 0;
    }

    /* ========== FILTER SECTION ========== */
    .filter-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-top: 4px solid #667eea;
    }

    .filter-title {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        color: #495057;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .filter-group input,
    .filter-group select {
        padding: 11px 14px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
        background: white;
        color: #333;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .filter-buttons {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .btn-filter {
        padding: 11px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
    }

    .btn-filter-search {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        flex: 1;
    }

    .btn-filter-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
    }

    .btn-filter-reset {
        background: #f8f9fa;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .btn-filter-reset:hover {
        background: white;
        border-color: #adb5bd;
    }

    /* ========== REPORT SECTION ========== */
    .report-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .report-header {
        text-align: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 3px solid #f1f3f5;
    }

    .report-title {
        font-size: 28px;
        font-weight: 800;
        color: #667eea;
        margin-bottom: 8px;
    }

    .report-subtitle {
        font-size: 16px;
        color: #7f8c8d;
        margin: 5px 0;
    }

    .report-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #667eea, transparent);
        margin: 15px auto;
    }

    /* ========== TABLE SECTION ========== */
    .table-responsive {
        overflow-x: auto;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .report-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .report-table th {
        padding: 18px 16px;
        text-align: left;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .report-table td {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        color: #333;
    }

    .report-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .report-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .report-table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-no {
        font-weight: 600;
        color: #667eea;
        text-align: center;
        width: 50px;
    }

    .table-product {
        font-weight: 600;
        color: #2c3e50;
    }

    .table-price {
        color: #27ae60;
        font-weight: 600;
    }

    .table-date {
        color: #7f8c8d;
        font-size: 13px;
    }

    /* ========== SUMMARY SECTION ========== */
    .summary-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
        padding: 25px 0;
        border-top: 2px solid #f1f3f5;
    }

    .summary-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }

    .summary-card:hover {
        transform: translateY(-3px);
        border-color: #667eea;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.1);
    }

    .summary-label {
        font-size: 12px;
        font-weight: 600;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .summary-value {
        font-size: 24px;
        font-weight: 800;
        color: #667eea;
        margin: 0;
    }

    .summary-card.highlighted {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .summary-card.highlighted .summary-label {
        color: rgba(255, 255, 255, 0.85);
    }

    .summary-card.highlighted .summary-value {
        color: white;
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
    }

    .empty-icon {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .empty-text {
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 25px;
    }

    /* ========== ACTIONS ========== */
    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-print {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(52, 152, 219, 0.4);
    }

    .btn-export {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(39, 174, 96, 0.4);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .report-section {
            padding: 20px;
        }

        .report-table th,
        .report-table td {
            padding: 12px 8px;
            font-size: 12px;
        }

        .report-title {
            font-size: 22px;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .summary-section {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }

    @media print {
        .filter-section,
        .action-buttons,
        .report-container > * {
            margin-bottom: 0 !important;
        }

        .report-section {
            box-shadow: none !important;
            background: white !important;
        }

        .report-table {
            page-break-inside: avoid;
        }
    }
</style>

<div class="report-container">
    <!-- FILTER SECTION -->
    <div class="filter-section">
        <div class="filter-title">🔍 Filter Laporan Penjualan</div>
        
        <form method="GET" action="{{ route('admin.reports.index') }}" class="filter-form">
            <div class="filter-grid">
                <div class="filter-group">
                    <label for="month">Bulan</label>
                    <select name="month" id="month" required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach($months as $key => $name)
                            <option value="{{ $key }}" @if($month == $key) selected @endif>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="year">Tahun</label>
                    <select name="year" id="year" required>
                        <option value="">-- Pilih Tahun --</option>
                        @for($y = 2020; $y <= now()->year + 1; $y++)
                            <option value="{{ $y }}" @if($year == $y) selected @endif>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn-filter btn-filter-search">
                    🔎 Cari Laporan
                </button>
                <a href="{{ route('admin.reports.index') }}" class="btn-filter btn-filter-reset">
                    ↻ Reset Filter
                </a>
            </div>
        </form>
    </div>

    <!-- REPORT SECTION -->
    <div class="report-section">
        <div class="report-header">
            <div class="report-title">📊 VANISHA BAKERY</div>
            <div class="report-subtitle">Laporan Penjualan Bulanan</div>
            @if($sales !== null)
                <div class="report-subtitle" style="font-size: 13px;">
                    Periode: <strong>{{ $months[$month] ?? '' }} {{ $year }}</strong>
                </div>
            @endif
            <div class="report-divider"></div>
        </div>

        @if($sales !== null && $sales->count() > 0)
            <!-- TABLE WITH DATA -->
            <div class="table-responsive">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">No</th>
                            <th style="width: 25%;">Produk</th>
                            <th style="width: 15%;">Pembeli</th>
                            <th style="width: 10%; text-align: center;">Qty</th>
                            <th style="width: 15%; text-align: right;">Harga Satuan</th>
                            <th style="width: 15%; text-align: right;">Total Harga</th>
                            <th style="width: 15%; text-align: center;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $index => $sale)
                            <tr>
                                <td class="table-no">{{ $index + 1 }}</td>
                                <td class="table-product">{{ $sale->product->name }}</td>
                                <td>{{ $sale->buyer_name }}</td>
                                <td style="text-align: center; font-weight: 600;">{{ $sale->quantity }} pcs</td>
                                <td style="text-align: right;" class="table-price">
                                    Rp {{ number_format($sale->price, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right; font-size: 15px; font-weight: 700;" class="table-price">
                                    Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                                </td>
                                <td class="table-date" style="text-align: center;">
                                    {{ $sale->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-section">
                <div class="summary-card">
                    <div class="summary-label">📦 Total Item</div>
                    <div class="summary-value">{{ $totalQuantity }} pcs</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">📋 Total Transaksi</div>
                    <div class="summary-value">{{ $sales->count() }} x</div>
                </div>

                <div class="summary-card highlighted">
                    <div class="summary-label">💰 Total Revenue</div>
                    <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="action-buttons">
                <a href="{{ route('admin.reports.export.sales.pdf', ['month' => $month, 'year' => $year]) }}" 
                   class="btn-action btn-print" target="_blank">
                    🖨️ Export PDF
                </a>
                <a href="{{ route('admin.reports.export.sales.excel', ['month' => $month, 'year' => $year]) }}" 
                   class="btn-action btn-export">
                    📥 Export Excel
                </a>
            </div>

        @elseif($sales !== null && $sales->count() === 0)
            <!-- EMPTY DATA STATE -->
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <div class="empty-title">Tidak Ada Data Penjualan</div>
                <div class="empty-text">
                    Periode <strong>{{ $months[$month] ?? '' }} {{ $year }}</strong> belum memiliki data penjualan
                </div>
            </div>

        @else
            <!-- INITIAL STATE - BEFORE FILTER -->
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <div class="empty-title">Pilih Filter Laporan</div>
                <div class="empty-text">Gunakan filter di atas untuk mencari data penjualan berdasarkan bulan dan tahun</div>
            </div>
        @endif
    </div>
</div>

@endsection
