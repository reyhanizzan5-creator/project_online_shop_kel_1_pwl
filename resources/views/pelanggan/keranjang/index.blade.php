@extends('layout.pelanggan')

@section('title', 'Keranjang Belanja')

@section('content')

    <h1 style="font-size:22px; margin-bottom:20px;">Keranjang Belanja</h1>

    @if ($items->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="cart" class="empty-state-icon" />
                <h3>Keranjang Anda masih kosong</h3>
                <p>Yuk mulai belanja dan temukan produk favorit Anda.</p>
                <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-primary" style="margin-top:16px;">Mulai Belanja</a>
            </div>
        </div>
    @else
        <div class="cart-layout">
            <div class="card">
                <div class="card-body">
                    @foreach ($items as $item)
                        <div class="cart-row" data-cart-row>
                            <img src="{{ $item->barang->gambar_url ?? asset('images/no-image.svg') }}" alt="" class="cart-row-photo">
                            <div class="cart-row-info">
                                <div class="nama">{{ $item->barang->nama_barang ?? 'Produk tidak ditemukan' }}</div>
                                <div class="harga-satuan">{{ $item->barang->harga_format ?? '' }} / item</div>
                            </div>

                            <form method="POST" action="{{ route('pelanggan.keranjang.update', $item) }}" data-cart-update-form>
                                @csrf
                                @method('PATCH')
                                <div class="input-stepper">
                                    <button type="button" data-step="down" aria-label="Kurangi jumlah"><x-icon name="minus" class="w-3.5 h-3.5" /></button>
                                    <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->barang->stok ?? 99 }}" inputmode="numeric">
                                    <button type="button" data-step="up" aria-label="Tambah jumlah"><x-icon name="plus" class="w-3.5 h-3.5" /></button>
                                </div>
                                <button type="submit" class="btn btn-outline btn-sm cart-update-fallback">Perbarui</button>
                            </form>

                            <div class="cart-row-subtotal angka" data-row-subtotal>{{ $item->subtotal_format }}</div>

                            <form method="POST" action="{{ route('pelanggan.keranjang.destroy', $item) }}" data-cart-delete-form>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart-row-remove" data-cart-remove aria-label="Hapus dari keranjang">
                                    <x-icon name="trash" class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card summary-card">
                <div class="card-body">
                    <h2 class="card-title" style="margin-bottom:14px;">Ringkasan Belanja</h2>
                    <div class="summary-row">
                        <span class="text-muted">Jumlah Item</span>
                        <span>{{ $items->sum('jumlah') }} item</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="v" data-cart-total>{{ $transaksi->total_harga_format }}</span>
                    </div>
                    <a href="{{ route('pelanggan.checkout') }}" class="btn btn-primary btn-block" style="margin-top:16px;">
                        Lanjut ke Checkout
                    </a>
                    <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-ghost btn-block" style="margin-top:8px;">
                        Tambah Produk Lain
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection
