<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    protected $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    public function index(Request $request)
    {
        $month = $request->query('month', now()->month);
        $year = $request->query('year', now()->year);
        $month = max(1, min(12, (int)$month));
        $year = max(2020, min(now()->year + 1, (int)$year));
        $sales = null;
        if ($request->has('month') || $request->has('year')) {
            $sales = Sale::with('product')->where('status', 'completed')
                ->whereMonth('created_at', $month)->whereYear('created_at', $year)->latest()->get();
        }
        return view('reports.index', [
            'sales' => $sales, 'months' => $this->months, 'month' => $month, 'year' => $year,
            'totalRevenue' => $sales ? $sales->sum('total_price') : 0,
            'totalQuantity' => $sales ? $sales->sum('quantity') : 0,
        ]);
    }

    public function sales(Request $request)
    {
        $month = $request->query('month', now()->month);
        $year = $request->query('year', now()->year);
        $month = max(1, min(12, (int)$month));
        $year = max(2020, min(now()->year + 1, (int)$year));
        $sales = Sale::with('product')->where('status', 'completed')
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)->latest()->paginate(20);
        return view('reports.sales', [
            'sales' => $sales, 'months' => $this->months, 'month' => $month, 'year' => $year,
            'totalRevenue' => $this->getTotalRevenue($month, $year),
            'totalQuantity' => $this->getTotalQuantity($month, $year),
        ]);
    }

    public function stock()
    {
        $products = Product::with('category')->orderBy('stock', 'asc')->paginate(20);
        return view('reports.stock', ['products' => $products]);
    }

    public function exportSalesExcel(Request $request)
    {
        $month = (int)$request->query('month', now()->month);
        $year = (int)$request->query('year', now()->year);
        $month = max(1, min(12, $month));
        $year = max(2020, min(2099, $year));

        $sales = Sale::with('product')->where('status', 'completed')
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->orderBy('created_at', 'asc')->get();

        $filename = 'Laporan_Penjualan_' . $this->months[$month] . '_' . $year . '.csv';

        return response()->streamDownload(function() use ($sales, $month, $year) {
            $output = fopen('php://output', 'w');
            
            // BOM UTF-8 untuk Excel Indonesia
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            // ========== TITLE ==========
            fputcsv($output, ['VANISHA BAKERY']);
            fputcsv($output, ['Laporan Penjualan Bulanan']);
            fputcsv($output, ['Periode ' . $this->months[$month] . ' ' . $year]);
            fputcsv($output, []);  // Blank row

            // ========== HEADER TABLE ==========
            fputcsv($output, [
                'No',
                'Produk',
                'Pembeli',
                'Qty (pcs)',
                'Harga Satuan (Rp)',
                'Total Harga (Rp)',
                'Tanggal'
            ]);

            // ========== DATA ROWS ==========
            $no = 1;
            foreach ($sales as $sale) {
                fputcsv($output, [
                    $no++,
                    $sale->product->name ?? '-',
                    $sale->buyer_name ?? '-',
                    (int)$sale->quantity,
                    (int)$sale->price,
                    (int)$sale->total_price,
                    $sale->created_at->format('d/m/Y H:i')
                ]);
            }

            // ========== BLANK ROW ==========
            fputcsv($output, []);

            // ========== SUMMARY SECTION ==========
            fputcsv($output, ['Total Kuantitas Terjual', '', '', '', '', (int)$sales->sum('quantity'), 'pcs']);
            fputcsv($output, ['Jumlah Transaksi', '', '', '', '', $sales->count(), 'x']);
            fputcsv($output, ['TOTAL PENDAPATAN', '', '', '', '', (int)$sales->sum('total_price'), 'Rp']);

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=utf-8-sig',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function exportSalesPDF(Request $request)
    {
        $month = (int)$request->query('month', now()->month);
        $year = (int)$request->query('year', now()->year);
        $month = max(1, min(12, $month));
        $year = max(2020, min(2099, $year));

        $sales = Sale::with('product')->where('status', 'completed')
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->orderBy('created_at', 'asc')->get();

        $pdf = Pdf::loadView('reports.sales-pdf', [
            'bulan' => $this->months[$month],
            'tahun' => $year,
            'sales' => $sales,
            'totalRevenue' => $sales->sum('total_price'),
            'totalQuantity' => $sales->sum('quantity'),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Penjualan_' . $this->months[$month] . '_' . $year . '.pdf');
    }

    public function exportStockExcel() 
    { 
        return response('Not implemented'); 
    }

    public function exportStockPDF() 
    { 
        return response('Not implemented'); 
    }

    private function getTotalRevenue($month, $year)
    {
        return Sale::where('status', 'completed')->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->sum('total_price');
    }

    private function getTotalQuantity($month, $year)
    {
        return Sale::where('status', 'completed')->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)->sum('quantity');
    }
}
