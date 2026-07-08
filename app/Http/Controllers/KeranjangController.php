<?php

namespace App\Http\Controllers;
use App\Models\Keranjang;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{

    public function index()
    {
        $keranjang = Keranjang::with(['barang'])->where('user_id', auth()->id())->get();
        return view('keranjang.index', compact('keranjang'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('keranjang.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        Keranjang::create([
            'user_id' => auth()->id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('keranjang.index');
    }

    public function show(string $id)
    {
        $keranjang = Keranjang::with(['barang'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('keranjang.show', compact('keranjang'));
    }

    public function edit(string $id)
    {
        $keranjang = Keranjang::with(['barang'])->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $barang = Barang::all();
        return view('keranjang.edit', compact('keranjang', 'barang'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $keranjang->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('keranjang.index');
    }

    public function destroy(string $id)
    {
        $keranjang = Keranjang::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $keranjang->delete();
        return redirect()->route('keranjang.index');
    }
}
