<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get month & year dari request
        $month = request('month', now()->month);
        $year = request('year', now()->year);

        // Months list
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Stats
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = Product::sum('stock');
        
        // Monthly stats
        $monthlyQuantity = Sale::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('quantity');
        
        $monthlySales = Sale::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('total_price');

        // Daily sales
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dailySales = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dailySales[$i] = Sale::whereDay('created_at', $i)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('total_price');
        }

        // Top 5 products
        $topProducts = Sale::selectRaw('product_id, SUM(quantity) as total')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total')
            ->toArray();

        $topProductNames = Sale::selectRaw('product_id, SUM(quantity) as total')
            ->with('product')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->pluck('product.name')
            ->toArray();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'monthlyQuantity',
            'monthlySales',
            'dailySales',
            'topProducts',
            'topProductNames',
            'months',
            'month',
            'year'
        ));
    }
}
