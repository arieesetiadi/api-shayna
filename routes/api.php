<?php

use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Products API
Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'all']);
});

// Checkout API
Route::prefix('/checkout')->group(function () {
    Route::post('/', [CheckoutController::class, 'checkout']);
});

// Transaction API
Route::prefix('/transactions')->group(function () {
    Route::get('/{id}', [TransactionController::class, 'get']);
});     
