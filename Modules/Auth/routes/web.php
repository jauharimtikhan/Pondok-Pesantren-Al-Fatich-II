<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\AuthController;

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
    Route::controller(AuthController::class)->group(function () {
        Route::get('/admin', 'index')->name('login')->middleware('guest');
        Route::get('/register', 'registerView')->name('register');
        Route::post('/login',  'authenticate')->name('login');
        Route::post('/register', 'create')->name('register');
        Route::get('/logout', 'destroy')->name('logout');
    });
});
