<?php

use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\PelangganController as AdminPelangganController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pelanggan\BarangController as PelangganBarangController;
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\KeranjangController;
use App\Http\Controllers\Pelanggan\ProfilController;
use App\Http\Controllers\Pelanggan\TransaksiController as PelangganTransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Autentikasi (untuk publik / hanya untuk tamu / belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Rute Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('kategori', AdminKategoriController::class)->except('show');
    Route::resource('barang', AdminBarangController::class)->except('show');
    Route::resource('pelanggan', AdminPelangganController::class)->except('show');

    Route::get('transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [AdminTransaksiController::class, 'show'])->name('transaksi.show');
    Route::patch('transaksi/{transaksi}', [AdminTransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('transaksi/{transaksi}', [AdminTransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

/*
|--------------------------------------------------------------------------
| Rute Pelanggan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('dashboard');

    Route::get('produk', [PelangganBarangController::class, 'index'])->name('produk.index');
    Route::get('produk/{barang}', [PelangganBarangController::class, 'show'])->name('produk.show');

    Route::get('keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::patch('keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::get('checkout', [PelangganTransaksiController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [PelangganTransaksiController::class, 'store'])->name('checkout.store');

    Route::get('transaksi', [PelangganTransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [PelangganTransaksiController::class, 'show'])->name('transaksi.show');

    Route::get('profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [ProfilController::class, 'update'])->name('profil.update');
});
