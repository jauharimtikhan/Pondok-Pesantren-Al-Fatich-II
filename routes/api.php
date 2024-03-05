<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\WakafController;
use Illuminate\Http\Request;
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
    Route::post('/payment/create', [TransactionController::class, 'create']);
    Route::post('/payment/update', [TransactionController::class, 'update']);

    // Route List Wakaf
    Route::get('/wakaf', [WakafController::class, 'getWakafPagination']);
    Route::get('/wakaf/{id}', [WakafController::class, 'getWakafById']);

    // Route List Paket Wakaf
    Route::get('/paket_wakaf/{id}', [WakafController::class, 'getPaketWakafApi']);

    Route::get('/test', function (Request $request) {
        $sum = "250000" + "250000.00";
        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'data' => $sum
        ]);
    });
});
