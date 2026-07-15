<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = Transaksi::riwayat()
            ->with('pelanggan')
            ->withCount('keranjangs')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->whereHas('pelanggan', fn ($q) => $q->where('nama', 'like', '%' . $request->cari . '%'));
            })
            ->latest('tanggal_transaksi')
            ->paginate(10)
            ->withQueryString();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function show(Transaksi $transaksi)
    {
        abort_if($transaksi->status === 'keranjang', 404);

        $transaksi->load(['pelanggan.user', 'keranjangs.barang']);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'status' => ['required', 'in:diproses,dikirim,selesai,dibatalkan'],
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        $statusSebelumnya = $transaksi->status;

        $transaksi->update(['status' => $data['status']]);

        if ($data['status'] === 'dibatalkan' && $statusSebelumnya !== 'dibatalkan') {
            $this->kembalikanStok($transaksi);
        }

        return redirect()->route('admin.transaksi.show', $transaksi)
            ->with('success', 'Status transaksi berhasil diperbarui menjadi "' . $transaksi->status_label . '".');
    }

    public function destroy(Transaksi $transaksi)
    {
        if (! in_array($transaksi->status, ['keranjang', 'dibatalkan'])) {
            $this->kembalikanStok($transaksi);
        }

        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    private function kembalikanStok(Transaksi $transaksi): void
    {
        foreach ($transaksi->keranjangs as $item) {
            $item->barang?->increment('stok', $item->jumlah);
        }
    }
}
