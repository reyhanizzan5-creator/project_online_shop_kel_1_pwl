@extends('layout.pelanggan')

@section('title', 'Checkout')

@section('content')

    <h1 style="font-size:22px; margin-bottom:20px;">Checkout</h1>

    <form method="POST" action="{{ route('pelanggan.checkout.store') }}">
        @csrf
        <div class="cart-layout">
            <div class="stack-md">
                <div class="card">
                    <div class="card-header"><h2 class="card-title">Ringkasan Pesanan</h2></div>
                    <div class="card-body" style="padding-top:8px; padding-bottom:8px;">
                        @foreach ($items as $item)
                            <div class="cart-row">
                                <img src="{{ $item->barang->gambar_url ?? asset('images/no-image.svg') }}" alt="" class="cart-row-photo">
                                <div class="cart-row-info">
                                    <div class="nama">{{ $item->barang->nama_barang ?? 'Produk tidak ditemukan' }}</div>
                                    <div class="harga-satuan">{{ $item->jumlah }} &times; {{ $item->barang->harga_format ?? '' }}</div>
                                </div>
                                <div class="cart-row-subtotal angka">{{ $item->subtotal_format }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h2 class="card-title">Alamat Pengiriman</h2></div>
                    <div class="card-body">
                        <div class="address-box">
                            <div class="nama">{{ $pelanggan->nama }}</div>
                            <div>{{ $pelanggan->no_hp }}</div>
                            <div>{{ $pelanggan->alamat }}, {{ $pelanggan->kode_pos }}</div>
                        </div>
                        <a href="{{ route('pelanggan.profil.edit') }}" class="form-hint" style="display:inline-block; margin-top:10px;">Alamat salah? Perbarui di halaman profil &rarr;</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h2 class="card-title">Metode Pembayaran</h2></div>
                    <div class="card-body">
                        <label class="payment-option">
                            <input type="radio" name="metode_pembayaran" value="transfer" @checked(old('metode_pembayaran', 'transfer') === 'transfer')>
                            <div>
                                <div class="judul">Transfer Bank</div>
                                <div class="ket">Transfer manual ke rekening toko setelah pesanan dibuat</div>
                            </div>
                        </label>
                        <label class="payment-option" style="margin-bottom:0;">
                            <input type="radio" name="metode_pembayaran" value="cod" @checked(old('metode_pembayaran') === 'cod')>
                            <div>
                                <div class="judul">Bayar di Tempat (COD)</div>
                                <div class="ket">Bayar tunai saat pesanan sampai di alamat Anda</div>
                            </div>
                        </label>
                        @error('metode_pembayaran') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="card summary-card">
                <div class="card-body">
                    <h2 class="card-title" style="margin-bottom:14px;">Total Pembayaran</h2>
                    <div class="summary-row">
                        <span class="text-muted">Subtotal ({{ $items->sum('jumlah') }} item)</span>
                        <span>{{ $transaksi->total_harga_format }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="v">{{ $transaksi->total_harga_format }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top:16px;">
                        Buat Pesanan
                    </button>
                    <a href="{{ route('pelanggan.keranjang.index') }}" class="btn btn-ghost btn-block" style="margin-top:8px;">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </form>

@endsection
