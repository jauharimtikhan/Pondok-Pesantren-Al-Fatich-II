<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('auth.login');
})->name('/');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware('LoggedIn')->group(function () {
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
});



Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'create'])->name('register');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
