<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/menu', [PublicController::class, 'menu'])->name('menu');
Route::post('/contact/send', [PublicController::class, 'sendContact'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Auth & Profile & Customer Area
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard for regular users (not admin)
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout (kalau mau wajib verifikasi, tambah 'verified')
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
});

/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Google OAuth (Socialite)
|--------------------------------------------------------------------------
*/

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // DASHBOARD ADMIN — nama route: admin.dashboard
        // DASHBOARD ADMIN — nama route: admin.dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Manajemen Kategori
        Route::resource('categories', CategoryController::class);

        // Manajemen Produk
        Route::resource('products', ProductController::class);

        // Manajemen Stock
        Route::resource('stocks', StockController::class);

        // Manajemen Penjualan
        Route::resource('sales', SalesController::class);

        // Laporan
        Route::get('reports/export/sales/pdf', [ReportController::class, 'exportSalesPDF'])->name('reports.export.sales.pdf');
        Route::get('reports/export/sales/excel', [ReportController::class, 'exportSalesExcel'])->name('reports.export.sales.excel');
        Route::resource('reports', ReportController::class)->only(['index']);

        // Manajemen User
        Route::resource('users', UserController::class);
    });

require __DIR__ . '/auth.php';
