<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('pelanggan', PelangganController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('barang', BarangController::class);
Route::resource('transaksi', TransaksiController::class);