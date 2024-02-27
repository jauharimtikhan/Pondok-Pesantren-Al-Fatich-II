<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('/')->middleware('guest');
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
    Route::get('/user', [UserController::class, 'store'])->name('user');
    Route::post('/user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('/user/edit', [UserController::class, 'update'])->name('user.edit');
    Route::get('/user/get', [UserController::class, 'get'])->name('user.get');
    Route::get('/user/get/{id}', [UserController::class, 'getById'])->name('user.getById');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    // Route Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori');
    Route::get('/kategori/get', [CategoryController::class, 'get'])->name('kategori.get');
    Route::get('/kategori/getbyid/{id}', [CategoryController::class, 'getById'])->name('kategori.getById');
    Route::post('/kategori/add', [CategoryController::class, 'create'])->name('kategori.add');
    Route::post('/kategori/edit', [CategoryController::class, 'update'])->name('kategori.edit');
    Route::delete('/kategori/delete/{id}', [CategoryController::class, 'destroy'])->name('kategori.delete');

    // Route Artikel
    Route::get('/artikel', [PostController::class, 'index'])->name('artikel');
    Route::get('/artikel/add', [PostController::class, 'addView'])->name('artikel.add');
});
