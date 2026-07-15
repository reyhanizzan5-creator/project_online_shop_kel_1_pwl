<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pelanggan = Auth::user()->pelanggan;

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $produkTerbaru = Barang::with('kategori')
            ->where('stok', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('pelanggan.dashboard', compact('pelanggan', 'kategoris', 'produkTerbaru'));
    }
}
