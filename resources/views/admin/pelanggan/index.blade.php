@extends('layout.admin')

@section('title', 'Pelanggan')
@section('breadcrumb', 'Kelola akun pelanggan toko Anda')

@section('content')

    <div class="toolbar">
        <form method="GET" class="search-box">
            <x-icon name="search" class="w-4 h-4" />
            <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama atau username…" data-autosubmit>
        </form>
        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary">
            <x-icon name="plus" class="w-4 h-4" /> Tambah Pelanggan
        </a>
    </div>

    @if ($pelanggans->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="users" class="empty-state-icon" />
                <h3>Belum ada pelanggan</h3>
                <p>Pelanggan akan muncul di sini setelah mereka mendaftar, atau tambahkan secara manual.</p>
            </div>
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>No. HP</th>
                        <th>Transaksi</th>
                        <th style="width:1%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggans as $pelanggan)
                        <tr>
                            <td class="td-strong">{{ $pelanggan->nama }}</td>
                            <td class="text-muted">{{ $pelanggan->user->username ?? '—' }}</td>
                            <td class="angka">{{ $pelanggan->no_hp }}</td>
                            <td><span class="badge badge-blue">{{ $pelanggan->jumlah_transaksi }}</span></td>
                            <td>
                                <div class="flex gap-sm">
                                    <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-outline btn-sm"><x-icon name="edit" class="w-4 h-4" /></a>
                                    <form method="POST" action="{{ route('admin.pelanggan.destroy', $pelanggan) }}"
                                          data-confirm="Hapus pelanggan &quot;{{ $pelanggan->nama }}&quot;? Tindakan ini tidak bisa dibatalkan.">
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

        {{ $pelanggans->links() }}
    @endif

@endsection
