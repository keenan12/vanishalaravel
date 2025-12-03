<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page { 
            margin: 15mm 15mm 15mm 15mm;
            size: A4 portrait;
        }
        html, body { height: 100%; }
        body { font-family: Arial, sans-serif; font-size: 10px; color: #333; }
        
        .page { width: 100%; max-width: 100%; padding: 0; }
        
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 6px; margin-bottom: 10px; }
        .header h1 { font-size: 16px; margin: 0 0 2px 0; font-weight: bold; }
        .header p { font-size: 10px; margin: 1px 0; }
        
        .info-bar { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 9px; }
        
        table { width: 100%; border-collapse: collapse; margin: 8px 0; font-size: 9px; }
        thead { background: #000; color: white; }
        th { padding: 5px 4px; text-align: left; border: 1px solid #000; font-weight: bold; font-size: 9px; }
        td { padding: 4px; border: 1px solid #999; font-size: 9px; }
        tbody tr:nth-child(even) { background: #f9f9f9; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .summary-box { margin: 10px auto; width: 70%; max-width: 70%; }
        .summary-row { display: table; width: 100%; border: 1px solid #000; margin: 0; }
        .summary-row:not(:last-child) { border-bottom: none; }
        .sum-label { display: table-cell; width: 60%; padding: 6px 8px; border-right: 1px solid #000; font-weight: bold; vertical-align: middle; font-size: 9px; }
        .sum-value { display: table-cell; width: 40%; padding: 6px 8px; text-align: right; font-weight: bold; vertical-align: middle; font-size: 9px; }
        .total-row { background: #d3d3d3; }
        
        .signature-section { margin-top: 20px; width: 100%; page-break-inside: avoid; }
        .sig-container { display: flex; justify-content: space-between; width: 100%; }
        .sig-box { width: 45%; text-align: center; }
        
        .sig-label { font-weight: bold; margin-bottom: 3px; font-size: 9px; }
        .sig-space { height: 40px; }
        .sig-line { border-bottom: 1px solid #000; width: 80%; margin: 0 auto; }
        .sig-name { font-size: 8px; margin-top: 3px; }
        
        .footer { text-align: center; font-size: 7px; color: #666; margin-top: 15px; padding-top: 6px; border-top: 1px solid #999; }
    </style>
</head>
<body>
    <div class="page">
        <!-- HEADER -->
        <div class="header">
            <h1>VANISHA BAKERY</h1>
            <p>Laporan Penjualan Bulanan</p>
            <p>{{ $bulan }} {{ $tahun }}</p>
        </div>

        <!-- INFO BAR -->
        <div class="info-bar">
            <span><strong>Tanggal:</strong> {{ now()->format('d/m/Y H:i') }}</span>
            <span><strong>Total Transaksi:</strong> {{ $sales->count() }} x</span>
        </div>

        @if($sales && $sales->count() > 0)
            <!-- TABLE DATA PENJUALAN -->
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 20%;">Produk</th>
                        <th style="width: 18%;">Pembeli</th>
                        <th style="width: 8%; text-align: center;">Qty</th>
                        <th style="width: 12%; text-align: right;">Harga</th>
                        <th style="width: 14%; text-align: right;">Total</th>
                        <th style="width: 13%; text-align: center;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $idx => $sale)
                        <tr>
                            <td class="text-center">{{ $idx + 1 }}</td>
                            <td>{{ $sale->product->name ?? '-' }}</td>
                            <td>{{ $sale->buyer_name ?? $sale->customer_name ?? 'Umum' }}</td>
                            <td class="text-center">{{ $sale->quantity }}</td>
                            <td class="text-right">Rp {{ number_format($sale->product->price, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $sale->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- SUMMARY SECTION -->
            <div class="summary-box">
                <div class="summary-row">
                    <div class="sum-label">Total Kuantitas Terjual</div>
                    <div class="sum-value">{{ number_format($totalQuantity, 0, ',', '.') }} pcs</div>
                </div>
                <div class="summary-row">
                    <div class="sum-label">Jumlah Transaksi</div>
                    <div class="sum-value">{{ $sales->count() }} x</div>
                </div>
                <div class="summary-row total-row">
                    <div class="sum-label">TOTAL PENDAPATAN</div>
                    <div class="sum-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- SIGNATURE SECTION -->
            <div class="signature-section">
                <div class="sig-container">
                    <!-- LEFT SIDE - Admin -->
                    <div class="sig-box">
                        <div class="sig-label">Admin</div>
                        <div class="sig-space"></div>
                        <div class="sig-line"></div>
                        <div class="sig-name">(_________________)</div>
                    </div>
                    
                    <!-- RIGHT SIDE - Mengetahui -->
                    <div class="sig-box">
                        <div class="sig-label">Jakarta, {{ now()->format('d/m/Y') }}</div>
                        <div class="sig-label" style="font-weight: normal; margin-top: 3px;">Mengetahui,</div>
                        <div class="sig-space"></div>
                        <div class="sig-line"></div>
                        <div class="sig-name">(_________________)</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- FOOTER -->
        <div class="footer">
            <p>Laporan ini dicetak otomatis oleh Sistem Vanisha Bakery © {{ now()->year }}</p>
        </div>
    </div>
</body>
</html>
