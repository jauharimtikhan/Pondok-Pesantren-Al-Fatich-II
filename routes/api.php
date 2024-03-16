<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\WakafController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    Route::controller(PaymentController::class)->group(function () {
        Route::post('/payment', 'getSnapToken');
        Route::get('/payment_status', 'getStatusPayment');
        Route::post('/payment/update_amount', 'updateLastAmount');
    });

    // Route Transaction
    Route::controller(TransactionController::class)->group(function () {
        Route::post('/payment/create', 'create');
        Route::post('/payment/update', 'update');
        Route::post('/payment/update/order_id', 'updateOrderId');
    });

    // Route List Wakaf
    Route::get('/wakaf', [WakafController::class, 'getWakafPagination']);
    Route::get('/wakaf/{id}', [WakafController::class, 'getWakafById']);

    // Route List Paket Wakaf
    Route::get('/paket_wakaf/{id}', [WakafController::class, 'getPaketWakafApi']);
});
