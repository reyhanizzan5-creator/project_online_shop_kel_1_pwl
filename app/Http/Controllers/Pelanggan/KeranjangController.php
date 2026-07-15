<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $pelanggan = Auth::user()->pelanggan;
        $transaksi = $pelanggan->keranjangAktif();
        $items = $transaksi->keranjangs()->with('barang.kategori')->latest()->get();

        return view('pelanggan.keranjang.index', compact('transaksi', 'items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'jumlah' => ['nullable', 'integer', 'min:1'],
        ], [
            'barang_id.required' => 'Barang tidak ditemukan.',
            'barang_id.exists' => 'Barang tidak ditemukan.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        $jumlahDiminta = $data['jumlah'] ?? 1;
        $barang = Barang::findOrFail($data['barang_id']);
        $pelanggan = Auth::user()->pelanggan;

        $hasil = DB::transaction(function () use ($pelanggan, $barang, $jumlahDiminta) {
            $transaksi = $pelanggan->keranjangAktif();
            $item = $transaksi->keranjangs()->where('barang_id', $barang->id)->first();
            $jumlahBaru = ($item->jumlah ?? 0) + $jumlahDiminta;

            if ($jumlahBaru > $barang->stok) {
                return [
                    'sukses' => false,
                    'pesan' => 'Stok "' . $barang->nama_barang . '" tidak mencukupi (tersisa ' . $barang->stok . ').',
                ];
            }

            if ($item) {
                $item->update(['jumlah' => $jumlahBaru]);
            } else {
                $transaksi->keranjangs()->create([
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlahBaru,
                ]);
            }

            $transaksi->hitungTotal();

            return ['sukses' => true, 'pesan' => $barang->nama_barang . ' berhasil ditambahkan ke keranjang.'];
        });

        if ($request->wantsJson()) {
            return response()->json($hasil + [
                'jumlah_item_keranjang' => $pelanggan->jumlah_item_keranjang,
            ], $hasil['sukses'] ? 200 : 422);
        }

        return $hasil['sukses']
            ? back()->with('success', $hasil['pesan'])
            : back()->with('error', $hasil['pesan']);
    }

    public function update(Request $request, Keranjang $keranjang)
    {
        $this->pastikanMilikSendiri($keranjang);

        $data = $request->validate([
            'jumlah' => ['required', 'integer', 'min:1'],
        ], [
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        $barang = $keranjang->barang;

        if ($data['jumlah'] > $barang->stok) {
            $pesan = 'Stok "' . $barang->nama_barang . '" hanya tersisa ' . $barang->stok . '.';

            return $request->wantsJson()
                ? response()->json(['sukses' => false, 'pesan' => $pesan], 422)
                : back()->with('error', $pesan);
        }

        $keranjang->update(['jumlah' => $data['jumlah']]);
        $transaksi = $keranjang->transaksi;
        $transaksi->hitungTotal();

        if ($request->wantsJson()) {
            return response()->json([
                'sukses' => true,
                'subtotal_format' => $keranjang->subtotal_format,
                'total_format' => $transaksi->total_harga_format,
            ]);
        }

        return back()->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    public function destroy(Request $request, Keranjang $keranjang)
    {
        $this->pastikanMilikSendiri($keranjang);

        $transaksi = $keranjang->transaksi;
        $namaBarang = $keranjang->barang->nama_barang ?? 'Barang';
        $keranjang->delete();
        $transaksi->hitungTotal();

        if ($request->wantsJson()) {
            return response()->json([
                'sukses' => true,
                'total_format' => $transaksi->total_harga_format,
                'keranjang_kosong' => $transaksi->keranjangs()->count() === 0,
            ]);
        }

        return back()->with('success', $namaBarang . ' dihapus dari keranjang.');
    }

    private function pastikanMilikSendiri(Keranjang $keranjang): void
    {
        $pelanggan = Auth::user()->pelanggan;

        abort_unless(
            $keranjang->transaksi
                && $keranjang->transaksi->pelanggan_id === $pelanggan->id
                && $keranjang->transaksi->status === 'keranjang',
            403,
            'Anda tidak berhak mengubah keranjang ini.'
        );
    }
}
