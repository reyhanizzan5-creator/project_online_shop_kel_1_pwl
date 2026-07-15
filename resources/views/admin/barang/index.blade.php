@extends('layout.admin')

@section('title', 'Produk')
@section('breadcrumb', 'Kelola katalog produk toko Anda')

@section('content')

    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search-box">
                <x-icon name="search" class="w-4 h-4" />
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari produk…" data-autosubmit>
            </div>
            <select name="kategori_id" class="form-control" onchange="this.form.requestSubmit()">
                <option value="">Semua Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
            <x-icon name="plus" class="w-4 h-4" /> Tambah Produk
        </a>
    </div>

    @if ($barangs->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="box" class="empty-state-icon" />
                <h3>Belum ada produk</h3>
                <p>Tambahkan produk pertama Anda supaya pelanggan bisa mulai berbelanja.</p>
            </div>
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width:1%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>
                                <div class="thumb-with-name">
                                    <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama_barang }}" class="table-thumb">
                                    <span class="nama">{{ $barang->nama_barang }}</span>
                                </div>
                            </td>
                            <td>{{ $barang->kategori->nama_kategori ?? '—' }}</td>
                            <td class="angka">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td><span class="stok-pill {{ $barang->stok_menipis ? 'menipis' : '' }}">{{ $barang->stok }}</span></td>
                            <td>
                                <div class="flex gap-sm">
                                    <a href="{{ route('admin.barang.edit', $barang) }}" class="btn btn-outline btn-sm"><x-icon name="edit" class="w-4 h-4" /></a>
                                    <form method="POST" action="{{ route('admin.barang.destroy', $barang) }}"
                                          data-confirm="Hapus produk &quot;{{ $barang->nama_barang }}&quot;? Tindakan ini tidak bisa dibatalkan.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><x-icon name="trash" class="w-4 h-4" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $barangs->links() }}
    @endif

@endsection
