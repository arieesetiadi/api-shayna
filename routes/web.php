<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('transactions')->group(function () {
        Route::get('/{id}/set-status', [TransactionController::class, 'setStatus'])->name('transactions.status');
    });

    // Product Resource
    Route::resources([
        '/products' => ProductController::class,
        '/product-galleries' => ProductGalleryController::class,
        '/transactions' => TransactionController::class
    ]);
});
