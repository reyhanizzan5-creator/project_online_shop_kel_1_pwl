@extends('layout.pelanggan')

@section('title', $barang->nama_barang)

@section('content')

    <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:18px;">
        <x-icon name="chevron-left" class="w-4 h-4" /> Kembali ke Produk
    </a>

    <div class="product-detail-grid">
        <div class="product-detail-photo">
            <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama_barang }}">
        </div>

        <div class="product-detail-info">
            <span class="eyebrow-kategori">{{ $barang->kategori->nama_kategori ?? 'Umum' }}</span>
            <h1 style="font-size:24px; margin-top:6px;">{{ $barang->nama_barang }}</h1>
            <div class="harga-besar">{{ $barang->harga_format }}</div>

            <div class="spec-row">
                <span class="k">Ketersediaan</span>
                <span class="v">
                    @if ($barang->stok > 0)
                        <span class="badge {{ $barang->stok_menipis ? 'badge-yellow' : 'badge-green' }}">{{ $barang->stok }} stok tersedia</span>
                    @else
                        <span class="badge badge-red">Stok habis</span>
                    @endif
                </span>
            </div>
            <div class="spec-row">
                <span class="k">Kategori</span>
                <span class="v">{{ $barang->kategori->nama_kategori ?? '—' }}</span>
            </div>

            @if ($barang->stok > 0)
                <form method="POST" action="{{ route('pelanggan.keranjang.store') }}" data-add-cart class="stack-md" style="margin-top:24px;">
                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Jumlah</label>
                        <div class="input-stepper">
                            <button type="button" data-step="down" aria-label="Kurangi jumlah"><x-icon name="minus" class="w-3.5 h-3.5" /></button>
                            <input type="number" name="jumlah" value="1" min="1" max="{{ $barang->stok }}" inputmode="numeric">
                            <button type="button" data-step="up" aria-label="Tambah jumlah"><x-icon name="plus" class="w-3.5 h-3.5" /></button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <x-icon name="cart" class="w-4 h-4" /> Tambah ke Keranjang
                    </button>
                </form>
            @else
                <button type="button" class="btn btn-outline btn-block" style="margin-top:24px;" disabled>Stok Habis</button>
            @endif
        </div>
    </div>

    @if ($produkTerkait->isNotEmpty())
        <div style="margin-top:52px;">
            <h2 style="font-size:18px; margin-bottom:16px;">Produk Terkait</h2>
            <div class="product-grid">
                @foreach ($produkTerkait as $terkait)
                    @include('pelanggan.produk._card', ['barang' => $terkait])
                @endforeach
            </div>
        </div>
    @endif

@endsection
