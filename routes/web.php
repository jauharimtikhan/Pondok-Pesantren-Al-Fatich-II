<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WakafController;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/login',  'authenticate')->name('login');
    Route::post('/register', 'create')->name('register');
    Route::get('/logout', 'destroy')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

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
    });

    // Route Wakaf
    Route::controller(WakafController::class)->group(function () {
        Route::get('/wakaf',  'index')->name('wakaf');
        Route::get('/paket_wakaf',  'ViewPaketWakaf')->name('paket_wakaf');
        Route::get('/wakaf/get',  'get')->name('wakaf.get');
        Route::get('/wakaf/getbyid/{id}',  'getById')->name('wakaf.getById');
        Route::post('/wakaf/add',  'create')->name('wakaf.add');
        Route::post('/wakaf/edit',  'update')->name('wakaf.edit');
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
});

// Route Guest
Route::middleware('web')->group(function () {
    Route::controller(LandingPageController::class)->group(function () {
        Route::get('/', 'index')->name('/');
        Route::get('/artikel/landing_page', 'artikel')->name('artikel.landing_page');
        Route::get('/artikel/landing_page/{id}', 'artikelById')->name('artikelById.landing_page');
    });

    Route::controller(WakafController::class)->group(function () {
        Route::get('/wakaf/landing_page', 'viewsWakaf')->name('wakaf.landing_page');
        Route::get('/wakaf/landing_page/{id}', 'viewsWakafById')->name('wakaf.landing_page.id');
        Route::get('/wakaf/landing_page/form/{id}', 'viewsFormWakaf')->name('wakaf.landing_page.form');
    });

    Route::get('/payment_success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment_failed', [PaymentController::class, 'failed'])->name('payment.failed');
});
