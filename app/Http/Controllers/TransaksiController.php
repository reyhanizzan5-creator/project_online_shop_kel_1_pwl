<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'keranjang.barang'])->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('transaksi.create', compact('pelanggan', 'barang'));
    }

    public function store(Request $request)
    {
        $transaksi = Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'total' => $request->total,
        ]);

        foreach ($request->keranjang as $item) {
            Keranjang::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('transaksi.index');
    }

    public function edit(string $id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'keranjang.barang'])->findOrFail($id);
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('transaksi.edit', compact('transaksi', 'pelanggan', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'pelanggan_id' => $request->pelanggan_id,
            'total' => $request->total,
        ]);

        // Update keranjang items
        foreach ($request->keranjang as $item) {
            $keranjang = Keranjang::findOrFail($item['id']);
            $keranjang->update([
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('transaksi.index');
    }

    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index');
    }
}
