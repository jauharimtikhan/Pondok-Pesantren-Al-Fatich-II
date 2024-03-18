<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\CategoryController;
use Modules\Admin\App\Http\Controllers\DonaturController;
use Modules\Admin\App\Http\Controllers\HomeController;
use Modules\Admin\App\Http\Controllers\KegiatanController;
use Modules\Admin\App\Http\Controllers\PostController;
use Modules\Admin\App\Http\Controllers\ProgramController;
use Modules\Admin\App\Http\Controllers\SettingsController;
use Modules\Admin\App\Http\Controllers\TransactionController;
use Modules\Admin\App\Http\Controllers\UserController;
use Modules\Admin\App\Http\Controllers\WakafController;

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

Route::middleware('auth')->group(function () {

    // Route Home
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/visitor', 'visitor')->name('home.visitor');
    });

    // Route User
    Route::controller(UserController::class)->group(function () {
        Route::get('/user',  'store')->name('user');
        Route::post('/user/add',  'create')->name('user.add');
        Route::post('/user/edit',  'update')->name('user.edit');
        Route::get('/user/get',  'get')->name('user.get');
        Route::get('/user/get/{id}',  'getById')->name('user.getById');
        Route::delete('/user/delete/{id}',  'destroy')->name('user.delete');
    });

    // Route Kategori
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/kategori',  'index')->name('kategori');
        Route::get('/kategori/get',  'get')->name('kategori.get');
        Route::get('/kategori/getbyid/{id}',  'getById')->name('kategori.getById');
        Route::post('/kategori/add',  'create')->name('kategori.add');
        Route::post('/kategori/edit',  'update')->name('kategori.edit');
        Route::delete('/kategori/delete/{id}',  'destroy')->name('kategori.delete');
    });

    // Route Artikel
    Route::controller(PostController::class)->group(function () {
        Route::get('/artikel',  'index')->name('artikel');
        Route::get('/artikel/add',  'addView')->name('artikel.add');
        Route::get('/artikel/edit/{id}',  'editView')->name('artikel.edit');
        Route::post('/artikel/upload_image',  'uploadImage')->name('artikel.upload_image');
        Route::post('/artikel/create', 'create')->name('artikel.create');
        Route::post('/artikel/update', 'update')->name('artikel.update');
        Route::delete('/artikel/delete/{id}', 'destroy')->name('artikel.delete');
    });

    // Route Wakaf
    Route::controller(WakafController::class)->group(function () {
        Route::get('/wakaf',  'index')->name('wakaf');
        Route::get('/paket_wakaf',  'ViewPaketWakaf')->name('paket_wakaf');
        Route::get('/wakaf/get',  'get')->name('wakaf.get');
        Route::get('/wakaf/getbyid/{id}',  'getById')->name('wakaf.getById');
        Route::post('/wakaf/add',  'create')->name('wakaf.add');
        Route::post('/wakaf/edit',  'update')->name('wakaf.edit');

        //Paket Wakaf 
        Route::post('/paket_wakaf/add',  'create_paket_wakaf')->name('paket_wakaf.add');
        Route::get('/paket_wakaf/get',  'getPaketWakaf')->name('paket_wakaf.get');
        Route::get('/pakte_wakaf/{id}',  'getPaketById')->name('paket_wakaf.getById');
        Route::post('/paket_wakaf/edit',  'update_paket_wakaf')->name('paket_wakaf.edit');
        Route::delete('/paket_wakaf/delete/{id}',  'paket_wakaf_destroy')->name('paket_wakaf.delete');
        Route::delete('/wakaf/delete/{id}',  'destroy')->name('wakaf.delete');
    });


    // Route Program
    Route::controller(ProgramController::class)->group(function () {
        Route::get('/program',  'index')->name('program');
        Route::get('/program/get',  'get')->name('program.get');
        Route::get('program/getById/{id}',  'getById')->name('program.getById');
        Route::post('/program,/add',  'create')->name('program.add');
        Route::post('/program/edit',  'update')->name('program.edit');
        Route::delete('program/delete/{id}',  'destroy')->name('program.delete');
    });

    // Route Kegiatan
    Route::controller(KegiatanController::class)->group(function () {
        Route::get('/kegiatan', 'index')->name('kegiatan');
        Route::get('/kegiatan/get', 'store')->name('kegiatan.get');
        Route::get('/kegiatan/getById/{id}', 'show')->name('kegiatan.getById');
        Route::post('/kegiatan/add', 'create')->name('kegiatan.add');
        Route::post('/kegiatan/update', 'update')->name('kegiatan.update');
        Route::delete('/kegiatan/delete/{id}', 'destroy')->name('kegiatan.delete');
    });

    // Route Settings
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::get('/setting/get', 'create')->name('settings.get');
        Route::post('/settings/update/{id}', 'update')->name('settings.update');

        // Route Specific Changed Password
        Route::get('/settings/change_password', 'changePassword')->name('settings.change_password');
        Route::post('/settings/change_password/store', 'changePasswordStore')->name('settings.change_password.store');
    });

    // Route Donatur
    Route::controller(DonaturController::class)->group(function () {
        Route::get('/donatur', 'index')->name('donatur');
        Route::get('/donatur/getDetails/{id}', 'getDetails')->name('donatur.getDetails');
    });

    // Route Transaksi
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaction');
    });
});
