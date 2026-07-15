@extends('layout.pelanggan')

@section('title', 'Detail Transaksi')

@section('content')

    <a href="{{ route('pelanggan.transaksi.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:18px;">
        <x-icon name="chevron-left" class="w-4 h-4" /> Kembali ke Riwayat
    </a>

    <div class="card receipt">
        <div class="card-body">
            <div class="flex-between" style="margin-bottom:6px;">
                <div>
                    <h1 style="font-size:19px; margin-bottom:2px;">Pesanan #{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</h1>
                    <div class="text-muted" style="font-size:13px;">{{ $transaksi->tanggal_transaksi?->translatedFormat('d F Y') }}</div>
                </div>
                <span class="{{ $transaksi->status_badge_class }}">{{ $transaksi->status_label }}</span>
            </div>

            <div style="margin-top:22px;">
                @foreach ($transaksi->keranjangs as $item)
                    <div class="receipt-item">
                        <div>
                            <div class="nama">{{ $item->barang->nama_barang ?? 'Produk sudah dihapus' }}</div>
                            <div class="rincian">{{ $item->jumlah }} &times; Rp {{ number_format($item->barang->harga ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div class="angka td-strong">{{ $item->subtotal_format }}</div>
                    </div>
                @endforeach
            </div>

            <div class="receipt-total">
                <span>Total</span>
                <span class="v">{{ $transaksi->total_harga_format }}</span>
            </div>

            <div class="stack-sm" style="margin-top:26px; padding-top:20px; border-top:1px solid var(--color-border); font-size:13.5px;">
                <div class="flex-between"><span class="text-muted">Metode Pembayaran</span><span class="td-strong">{{ $transaksi->metode_pembayaran === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank' }}</span></div>
                <div class="flex-between"><span class="text-muted">Dikirim ke</span><span class="td-strong" style="text-align:right; max-width:60%;">{{ $transaksi->pelanggan->alamat ?? '—' }}</span></div>
            </div>
        </div>
    </div>

@endsection
