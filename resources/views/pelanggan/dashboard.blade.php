@extends('layout.pelanggan')

@section('title', 'Beranda')

@section('content')

    <div class="shop-welcome">
        <div>
            <span class="eyebrow">Halo, {{ $pelanggan->nama ?? auth()->user()->name }}</span>
            <h1>Belanja apa hari ini Bos?</h1>
        </div>
    </div>

    <div class="stack-md" style="margin-top:22px;">
        <div class="kategori-chips">
            <a href="{{ route('pelanggan.produk.index') }}" class="kategori-chip is-active">Semua</a>
            @foreach ($kategoris as $kategori)
                <a href="{{ route('pelanggan.produk.index', ['kategori_id' => $kategori->id]) }}" class="kategori-chip">{{ $kategori->nama_kategori }}</a>
            @endforeach
        </div>
    </div>

    <div class="flex-between" style="margin-top:32px; margin-bottom:16px;">
        <h2 style="font-size:18px; margin:0;">Produk Terbaru</h2>
        <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-outline btn-sm">Lihat Semua Produk</a>
    </div>

    @if ($produkTerbaru->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="box" class="empty-state-icon" />
                <h3>Belum ada produk tersedia</h3>
                <p>Silakan kembali lagi nanti.</p>
            </div>
        </div>
    @else
        <div class="product-grid">
            @foreach ($produkTerbaru as $barang)
                @include('pelanggan.produk._card', ['barang' => $barang])
            @endforeach
        </div>
    @endif

@endsection
