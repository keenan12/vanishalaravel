<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // Controller Admin
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CheckoutController; 
use Illuminate\Support\Facades\Route;

// --- ROUTES PUBLIC (TANPA LOGIN) ---
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/menu', [PublicController::class, 'menu'])->name('menu');
Route::post('/contact', [PublicController::class, 'sendContact'])->name('contact.send');


// 🛑 JALUR KHUSUS ADMIN (Dilindungi Middleware 'admin')

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // URL: /admin/dashboard | Name: admin.dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

    // Resource Controllers Admin
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('sales', SalesController::class);

    // Reports Admin
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
    
    // Exports
    Route::get('/reports/export-sales-excel', [ReportController::class, 'exportSalesExcel'])->name('reports.export.sales.excel');
    Route::get('/reports/export-sales-pdf', [ReportController::class, 'exportSalesPDF'])->name('reports.export.sales.pdf');
    Route::get('/reports/export-stock-excel', [ReportController::class, 'exportStockExcel'])->name('reports.export.stock.excel');
    Route::get('/reports/export-stock-pdf', [ReportController::class, 'exportStockPDF'])->name('reports.export.stock.pdf');
});


// 👤 JALUR KHUSUS CUSTOMER (Hanya butuh Login)

Route::middleware('auth')->group(function () {
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    Route::get('/my-account', [PublicController::class, 'index'])->name('dashboard'); 

    // Profile Routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::post('/profile/photo/delete', [ProfileController::class, 'removePhoto'])->name('profile.removePhoto');
    
    // Logout
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});


require __DIR__.'/auth.php';