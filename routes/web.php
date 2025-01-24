<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->get('/dashboard', [PenjualanController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);
    Route::resource('users', UserController::class);
});

// Auth Routes
Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
