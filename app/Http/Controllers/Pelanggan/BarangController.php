<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barangs = Barang::with('kategori')
            ->cari($request->cari)
            ->when($request->filled('kategori_id'), fn ($query) => $query->where('kategori_id', $request->kategori_id))
            ->orderBy('nama_barang')
            ->paginate(12)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('pelanggan.produk.index', compact('barangs', 'kategoris'));
    }

    public function show(Barang $barang)
    {
        $barang->load('kategori');

        $produkTerkait = Barang::where('kategori_id', $barang->kategori_id)
            ->where('id', '!=', $barang->id)
            ->take(4)
            ->get();

        return view('pelanggan.produk.show', compact('barang', 'produkTerkait'));
    }
}
