@extends('layout.pelanggan')

@section('title', 'Semua Produk')

@section('content')

    <div class="flex-between flex-wrap gap-md" style="margin-bottom:18px;">
        <h1 style="font-size:22px; margin:0;">Katalog Produk</h1>
        <form method="GET" class="search-box" style="max-width:280px;">
            @if (request()->filled('kategori_id'))
                <input type="hidden" name="kategori_id" value="{{ request('kategori_id') }}">
            @endif
            <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari produk…" data-autosubmit>
        </form>
    </div>

    <div class="kategori-chips" style="margin-bottom:24px;">
        <a href="{{ route('pelanggan.produk.index', ['cari' => request('cari')]) }}" class="kategori-chip {{ request('kategori_id') ? '' : 'is-active' }}">Semua</a>
        @foreach ($kategoris as $kategori)
            <a href="{{ route('pelanggan.produk.index', ['kategori_id' => $kategori->id, 'cari' => request('cari')]) }}"
               class="kategori-chip {{ request('kategori_id') == $kategori->id ? 'is-active' : '' }}">{{ $kategori->nama_kategori }}</a>
        @endforeach
    </div>

    @if ($barangs->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="search" class="empty-state-icon" />
                <h3>Produk tidak ditemukan</h3>
                <p>Coba kata kunci atau kategori lain.</p>
            </div>
        </div>
    @else
        <div class="product-grid">
            @foreach ($barangs as $barang)
                @include('pelanggan.produk._card', ['barang' => $barang])
            @endforeach
        </div>

        {{ $barangs->links() }}
    @endif

@endsection
