<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function checkout()
    {
        $pelanggan = Auth::user()->pelanggan;
        $transaksi = $pelanggan->keranjangAktif();
        $items = $transaksi->keranjangs()->with('barang')->get();

        if ($items->isEmpty()) {
            return redirect()->route('pelanggan.keranjang.index')
                ->with('error', 'Keranjang Anda masih kosong, silakan pilih produk terlebih dahulu.');
        }

        return view('pelanggan.checkout', compact('pelanggan', 'transaksi', 'items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'metode_pembayaran' => ['required', 'in:transfer,cod'],
        ], [
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
        ]);

        $pelanggan = Auth::user()->pelanggan;
        $transaksi = $pelanggan->keranjangAktif();
        $items = $transaksi->keranjangs()->with('barang')->get();

        if ($items->isEmpty()) {
            return redirect()->route('pelanggan.keranjang.index')
                ->with('error', 'Keranjang Anda masih kosong.');
        }

        foreach ($items as $item) {
            if (! $item->barang || $item->jumlah > $item->barang->stok) {
                return redirect()->route('pelanggan.keranjang.index')
                    ->with('error', 'Stok "' . ($item->barang->nama_barang ?? 'salah satu barang') . '" tidak lagi mencukupi. Silakan sesuaikan jumlahnya.');
            }
        }

        DB::transaction(function () use ($transaksi, $items, $data) {
            foreach ($items as $item) {
                $item->barang()->decrement('stok', $item->jumlah);
            }

            $transaksi->update([
                'status' => 'diproses',
                'tanggal_transaksi' => now(),
                'metode_pembayaran' => $data['metode_pembayaran'],
            ]);

            $transaksi->hitungTotal();
        });

        return redirect()->route('pelanggan.transaksi.show', $transaksi)
            ->with('success', 'Pesanan berhasil dibuat! Terima kasih sudah berbelanja.');
    }

    public function index()
    {
        $pelanggan = Auth::user()->pelanggan;
        $transaksis = $pelanggan->riwayatTransaksi()->withCount('keranjangs')->paginate(10);

        return view('pelanggan.transaksi.index', compact('transaksis'));
    }

    public function show(Transaksi $transaksi)
    {
        $pelanggan = Auth::user()->pelanggan;

        abort_unless(
            $transaksi->pelanggan_id === $pelanggan->id && $transaksi->status !== 'keranjang',
            404
        );

        $transaksi->load('keranjangs.barang');

        return view('pelanggan.transaksi.show', compact('transaksi'));
    }
}
