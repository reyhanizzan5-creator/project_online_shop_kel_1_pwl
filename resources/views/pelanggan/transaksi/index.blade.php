@extends('layout.pelanggan')

@section('title', 'Riwayat Transaksi')

@section('content')

    <h1 style="font-size:22px; margin-bottom:20px;">Riwayat Transaksi</h1>

    @if ($transaksis->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="receipt" class="empty-state-icon" />
                <h3>Belum ada transaksi</h3>
                <p>Pesanan yang sudah Anda checkout akan muncul di sini.</p>
                <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-primary" style="margin-top:16px;">Mulai Belanja</a>
            </div>
        </div>
    @else
        <div class="stack-md">
            @foreach ($transaksis as $trx)
                <a href="{{ route('pelanggan.transaksi.show', $trx) }}" class="card order-card">
                    <div class="order-card-head">
                        <div>
                            <span class="kode">#{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <div class="tanggal">{{ $trx->tanggal_transaksi?->translatedFormat('d F Y') }}</div>
                        </div>
                        <span class="{{ $trx->status_badge_class }}">{{ $trx->status_label }}</span>
                    </div>
                    <div class="text-muted" style="font-size:13.5px;">{{ $trx->keranjangs_count }} produk</div>
                    <div class="order-card-foot">
                        <span class="text-muted" style="font-size:13px;">
                            {{ $trx->metode_pembayaran === 'cod' ? 'Bayar di Tempat' : 'Transfer Bank' }}
                        </span>
                        <span class="total angka">{{ $trx->total_harga_format }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $transaksis->links() }}
    @endif

@endsection
