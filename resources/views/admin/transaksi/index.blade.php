@extends('layout.admin')

@section('title', 'Transaksi')
@section('breadcrumb', 'Pantau seluruh pesanan pelanggan')

@section('content')

    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <div class="search-box">
                <x-icon name="search" class="w-4 h-4" />
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama pelanggan…" data-autosubmit>
            </div>
            <select name="status" class="form-control" onchange="this.form.requestSubmit()">
                <option value="">Semua Status</option>
                @foreach (['diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') == $value)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
    </div>

    @if ($transaksis->isEmpty())
        <div class="card">
            <div class="empty-state">
                <x-icon name="receipt" class="empty-state-icon" />
                <h3>Belum ada transaksi</h3>
                <p>Transaksi pelanggan akan muncul di sini setelah mereka checkout.</p>
            </div>
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th style="width:1%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $trx)
                        <tr>
                            <td class="angka text-muted">#{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="td-strong">{{ $trx->pelanggan->nama ?? '—' }}</td>
                            <td>{{ $trx->tanggal_transaksi?->translatedFormat('d M Y') }}</td>
                            <td>{{ $trx->keranjangs_count }}</td>
                            <td class="angka">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td><span class="{{ $trx->status_badge_class }}">{{ $trx->status_label }}</span></td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $trx) }}" class="btn btn-outline btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $transaksis->links() }}
    @endif

@endsection
