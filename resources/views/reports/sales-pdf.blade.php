<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        
        .page { width: 100%; page-break-after: always; padding: 15px 15px; }
        
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 8px; margin-bottom: 12px; }
        .header h1 { font-size: 18px; margin: 0 0 3px 0; font-weight: bold; }
        .header p { font-size: 11px; margin: 1px 0; }
        
        .info-bar { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 10px; }
        thead { background: #000; color: white; }
        th { padding: 6px; text-align: left; border: 1px solid #000; font-weight: bold; }
        td { padding: 5px; border: 1px solid #999; }
        tbody tr:nth-child(even) { background: #f9f9f9; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .summary-box { margin: 15px 0; width: 100%; }
        .summary-row { display: table; width: 100%; border: 1px solid #000; margin: 0; }
        .summary-row:not(:last-child) { border-bottom: none; }
        .sum-label { display: table-cell; width: 65%; padding: 7px; border-right: 1px solid #000; font-weight: bold; vertical-align: middle; }
        .sum-value { display: table-cell; width: 35%; padding: 7px 5px; text-align: right; font-weight: bold; vertical-align: middle; }
        .total-row { background: #d3d3d3; }
        
        .signature-section { margin-top: 30px; width: 100%; }
        .sig-container { display: table; width: 100%; }
        .sig-left { display: table-cell; width: 50%; vertical-align: top; padding-right: 15px; text-align: center; }
        .sig-right { display: table-cell; width: 50%; vertical-align: top; padding-left: 15px; text-align: center; }
        
        .sig-name { font-weight: bold; margin-bottom: 35px; font-size: 10px; }
        .sig-line { border-top: 1px solid #000; margin: 0; height: 25px; }
        .sig-title { font-size: 9px; margin-top: 3px; }
        
        .footer { text-align: center; font-size: 8px; color: #666; margin-top: 15px; padding-top: 8px; border-top: 1px solid #999; }
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
                            <td>{{ $sale->buyer_name ?? '-' }}</td>
                            <td class="text-center">{{ $sale->quantity }}</td>
                            <td class="text-right">{{ number_format($sale->price, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($sale->total_price, 0, ',', '.') }}</td>
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

            <!-- SIGNATURE SECTION - BALANCED LEFT & RIGHT -->
            <div class="signature-section">
                <div class="sig-container">
                    <!-- LEFT SIDE -->
                    <div class="sig-left">
                        <div class="sig-name">Admin</div>
                        <div class="sig-line"></div>
                        <div class="sig-title">(_________________)</div>
                    </div>
                    
                    <!-- RIGHT SIDE -->
                    <div class="sig-right">
                        <div class="sig-name">Jakarta, {{ now()->format('d/m/Y') }}</div>
                        <p style="margin-bottom: 35px; font-size: 9px;">Mengetahui,</p>
                        <div class="sig-line"></div>
                        <div class="sig-title">(_________________)</div>
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
