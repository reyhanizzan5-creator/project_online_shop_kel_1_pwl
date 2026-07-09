<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::middleware(['auth', 'pelanggan'])->prefix('pelanggan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('barang', BarangController::class);
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');