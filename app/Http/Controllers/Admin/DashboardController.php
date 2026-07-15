<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::riwayat()->count();

        $totalPendapatan = Transaksi::riwayat()
            ->whereIn('status', ['diproses', 'dikirim', 'selesai'])
            ->sum('total_harga');

        $transaksiTerbaru = Transaksi::riwayat()
            ->with('pelanggan')
            ->latest('tanggal_transaksi')
            ->take(5)
            ->get();

        $barangStokMenipis = Barang::where('stok', '<=', 5)
            ->orderBy('stok')
            ->take(5)
            ->get();

        $produkTerlaris = Keranjang::query()
            ->select('barang_id')
            ->selectRaw('SUM(jumlah) as total_terjual')
            ->whereHas('transaksi', function ($query) {
                $query->whereIn('status', ['diproses', 'dikirim', 'selesai']);
            })
            ->with('barang')
            ->groupBy('barang_id')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalKategori',
            'totalBarang',
            'totalPelanggan',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiTerbaru',
            'barangStokMenipis',
            'produkTerlaris',
        ));
    }
}
