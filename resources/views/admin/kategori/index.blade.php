@extends('layout.admin')

@section('title', 'Kategori')
@section('breadcrumb', 'Kelola kategori produk toko Anda')

@section('content')

    <div class="toolbar">
        <form method="GET" class="search-box">
            <x-icon name="search" class="w-4 h-4" />
            <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari kategori…" data-autosubmit>
        </form>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <x-icon name="plus" class="w-4 h-4" /> Tambah Kategori
        </a>
    </div>

    @if ($kategoris->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="tag" class="empty-state-icon" />
                <h3>Belum ada kategori</h3>
                <p>Mulai dengan menambahkan kategori pertama untuk mengelompokkan produk Anda.</p>
            </div>
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Jumlah Produk</th>
                        <th style="width:1%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                        <tr>
                            <td class="td-strong">{{ $kategori->nama_kategori }}</td>
                            <td><span class="badge badge-blue">{{ $kategori->barang_count }} produk</span></td>
                            <td>
                                <div class="flex gap-sm">
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-outline btn-sm"><x-icon name="edit" class="w-4 h-4" /></a>
                                    <form method="POST" action="{{ route('admin.kategori.destroy', $kategori) }}"
                                          data-confirm="Hapus kategori &quot;{{ $kategori->nama_kategori }}&quot;? Tindakan ini tidak bisa dibatalkan.">
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

        {{ $kategoris->links() }}
    @endif

@endsection
