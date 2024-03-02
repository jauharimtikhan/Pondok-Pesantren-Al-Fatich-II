<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\WakafController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('LoggedOut')->group(function () {
    // Route Payment
    Route::post('/payment', [PaymentController::class, 'store']);
    Route::get('/payment_status', [PaymentController::class, 'getStatusPayment']);
    Route::post('/payment/update_amount', [PaymentController::class, 'updateLastAmount']);

    // Route List Wakaf
    Route::get('/wakaf', [WakafController::class, 'getWakafPagination']);
    Route::get('/wakaf/{id}', [WakafController::class, 'getWakafById']);

    // Route List Paket Wakaf
    Route::get('/paket_wakaf/{id}', [WakafController::class, 'getPaketWakafApi']);
});
