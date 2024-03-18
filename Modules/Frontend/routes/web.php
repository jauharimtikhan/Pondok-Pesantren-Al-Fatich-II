<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\App\Http\Controllers\PaymentController;
use Modules\Frontend\App\Http\Controllers\LandingPageController;
use Modules\Frontend\App\Http\Controllers\WakafController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::middleware('web')->group(function () {
        Route::controller(LandingPageController::class)->group(function () {
            Route::get('/', 'index')->name('/');
            Route::get('/artikel/landing_page', 'artikel')->name('artikel.landing_page');
            Route::get('/artikel/landing_page/{id}', 'artikelById')->name('artikelById.landing_page');
            Route::post('/artikel/search', 'search')->name('artikel.search');
        });

        Route::controller(WakafController::class)->group(function () {
            Route::get('/wakaf/landing_page', 'viewsWakaf')->name('wakaf.landing_page');
            Route::get('/wakaf/landing_page/{id}', 'viewsWakafById')->name('wakaf.landing_page.id');
            Route::get('/wakaf/landing_page/form/{id}', 'viewsFormWakaf')->name('wakaf.landing_page.form');
        });

        Route::get('/payment_success', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('/payment_failed', [PaymentController::class, 'failed'])->name('payment.failed');
    });
});
