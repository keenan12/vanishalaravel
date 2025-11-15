@extends('layouts.app')

@section('breadcrumb')
    Dashboard
@endsection

@section('content')

<!-- FILTER BULAN & TAHUN -->
<div class="card" style="margin-bottom: 25px;">
    <form method="GET" action="{{ route('dashboard') }}" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 200px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">📅 Pilih Bulan</label>
            <select name="month" class="form-control" style="width: 100%; padding: 11px 14px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; background-color: white; cursor: pointer; transition: border-color 0.3s;">
                @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="flex: 1; min-width: 150px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px;">📆 Tahun</label>
            <select name="year" class="form-control" style="width: 100%; padding: 11px 14px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 14px; background-color: white; cursor: pointer;">
                @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 10px 20px; white-space: nowrap; font-weight: 600; border-radius: 6px;">🔍 Lihat Data</button>
    </form>
</div>

<!-- STATISTIK CARDS - LEBIH MENARIK -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
    
    <!-- Card 1: Total Produk -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 25px; color: white; box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.1;">📦</div>
        <div style="position: relative; z-index: 1;">
            <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Produk</div>
            <div style="font-size: 40px; font-weight: bold; margin-bottom: 5px;">{{ $totalProducts }}</div>
            <div style="font-size: 12px; opacity: 0.8;">Produk tersedia</div>
        </div>
    </div>

    <!-- Card 2: Penjualan Bulan Ini (Qty) -->
    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; padding: 25px; color: white; box-shadow: 0 8px 16px rgba(245, 87, 108, 0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.1;">📊</div>
        <div style="position: relative; z-index: 1;">
            <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Penjualan Bulan Ini</div>
            <div style="font-size: 40px; font-weight: bold; margin-bottom: 5px;">{{ $monthlyQuantity }} pcs</div>
            <div style="font-size: 12px; opacity: 0.8;">Jumlah item terjual</div>
        </div>
    </div>

    <!-- Card 3: Revenue Bulan Ini -->
    <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; padding: 25px; color: white; box-shadow: 0 8px 16px rgba(79, 172, 254, 0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.1;">💰</div>
        <div style="position: relative; z-index: 1;">
            <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Revenue Bulan Ini</div>
            <div style="font-size: 32px; font-weight: bold; margin-bottom: 5px;">Rp {{ number_format($monthlySales, 0, ',', '.') }}</div>
            <div style="font-size: 12px; opacity: 0.8;">Total pendapatan</div>
        </div>
    </div>

    <!-- Card 4: Total Stock -->
    <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px; padding: 25px; color: white; box-shadow: 0 8px 16px rgba(250, 112, 154, 0.3); position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.1;">📈</div>
        <div style="position: relative; z-index: 1;">
            <div style="font-size: 12px; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Total Stock</div>
            <div style="font-size: 40px; font-weight: bold; margin-bottom: 5px;">{{ $totalStock }} pcs</div>
            <div style="font-size: 12px; opacity: 0.8;">Stock keseluruhan</div>
        </div>
    </div>
</div>

<!-- CHART SECTION -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 25px; margin-bottom: 30px;">
    
    <!-- Chart Penjualan Harian -->
    <div class="card" style="border-top: 4px solid #667eea;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">📈 Penjualan Harian</h3>
            <span style="font-size: 12px; background-color: rgba(102, 126, 234, 0.2); color: #667eea; padding: 4px 12px; border-radius: 20px;">Bulan {{ $months[$month] ?? 'Ini' }}</span>
        </div>
        <canvas id="dailySalesChart" style="max-height: 300px;"></canvas>
    </div>

    <!-- Chart Top 5 Produk -->
    <div class="card" style="border-top: 4px solid #f5576c;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">🏆 Top 5 Produk Terlaris</h3>
            <span style="font-size: 12px; background-color: rgba(245, 87, 108, 0.2); color: #f5576c; padding: 4px 12px; border-radius: 20px;">Top Sellers</span>
        </div>
        <canvas id="topProductsChart" style="max-height: 300px;"></canvas>
    </div>
</div>

<!-- PRODUK STOCK RENDAH & PENJUALAN TERBARU -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- Produk Stok Rendah -->
    <div class="card">
        <div class="card-header">⚠️ Produk Stock Rendah</div>
        <table style="font-size: 13px;">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th style="text-align: center;">Stock</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $lowStockProducts = \App\Models\Product::where('stock', '<', 20)->orderBy('stock', 'asc')->get();
                @endphp
                @forelse($lowStockProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td style="color: #e74c3c; font-weight: bold; text-align: center;">{{ $product->stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align: center; color: #999; padding: 20px;">✅ Semua stock aman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Penjualan Terbaru -->
    <div class="card">
        <div class="card-header">📊 Penjualan Terbaru</div>
        <table style="font-size: 13px;">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $recentSales = \App\Models\Sale::with('product')->where('status', 'completed')->latest()->take(5)->get();
                @endphp
                @forelse($recentSales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td style="text-align: center;">{{ $sale->quantity }}</td>
                        <td style="text-align: right; font-weight: bold;">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: #999; padding: 20px;">Belum ada penjualan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- QUICK LINKS -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-top: 30px;">
    <a href="{{ route('products.index') }}" style="background: white; padding: 20px; border-radius: 8px; text-align: center; text-decoration: none; color: #667eea; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s; cursor: pointer;">
        📦 Kelola Produk
    </a>
    <a href="{{ route('stocks.index') }}" style="background: white; padding: 20px; border-radius: 8px; text-align: center; text-decoration: none; color: #f5576c; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s; cursor: pointer;">
        📊 Kelola Stock
    </a>
    <a href="{{ route('sales.index') }}" style="background: white; padding: 20px; border-radius: 8px; text-align: center; text-decoration: none; color: #4facfe; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s; cursor: pointer;">
        💳 Catat Penjualan
    </a>
    <a href="{{ route('reports.index') }}" style="background: white; padding: 20px; border-radius: 8px; text-align: center; text-decoration: none; color: #fa709a; font-weight: 600; border: 2px solid #e0e0e0; transition: all 0.3s; cursor: pointer;">
        📋 Lihat Laporan
    </a>
</div>

<!-- SCRIPT CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Penjualan Harian
    const ctx1 = document.getElementById('dailySalesChart').getContext('2d');
    const dailyData = @json($dailySales);
    
    // Generate semua hari dalam bulan
    const daysInMonth = new Date(@json($year), @json($month), 0).getDate();
    const days = [];
    const amounts = [];
    
    for(let i = 1; i <= daysInMonth; i++) {
        days.push('Tgl ' + i);
        amounts.push(dailyData[i] || 0);
    }

    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: amounts,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12, weight: 'bold' },
                        padding: 15,
                        usePointStyle: true,
                        color: '#333'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    borderColor: '#667eea',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Chart Top 5 Produk
    const ctx2 = document.getElementById('topProductsChart').getContext('2d');
    const topProductNames = @json($topProductNames);
    const topProductData = @json($topProducts);

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: topProductNames.length > 0 ? topProductNames : ['Belum ada data'],
            datasets: [{
                label: 'Jumlah Terjual (pcs)',
                data: topProductData.length > 0 ? topProductData : [0],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(245, 87, 108, 0.8)',
                    'rgba(79, 172, 254, 0.8)',
                    'rgba(250, 112, 154, 0.8)',
                    'rgba(254, 225, 64, 0.8)',
                ],
                borderColor: [
                    '#667eea',
                    '#f5576c',
                    '#4facfe',
                    '#fa709a',
                    '#fee140',
                ],
                borderWidth: 2,
                borderRadius: 8,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12, weight: 'bold' },
                        padding: 15,
                        color: '#333'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

@endsection
