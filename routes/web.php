<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    PenjualanController,
    ProdukController,
};

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('produk', ProdukController::class);
Route::resource('penjualan', PenjualanController::class);

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


