@extends('layout.admin')

@section('title', 'Detail Transaksi')
@section('breadcrumb')
    <a href="{{ route('admin.transaksi.index') }}" style="color:inherit;">Transaksi</a> / #{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}
@endsection

@section('content')

    <div class="admin-grid-2">
        <div class="stack-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Rincian Barang</h2>
                    <span class="{{ $transaksi->status_badge_class }}">{{ $transaksi->status_label }}</span>
                </div>
                <div class="table-wrap" style="border:none; border-radius:0;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->keranjangs as $item)
                                <tr>
                                    <td class="thumb-with-name">
                                        <img src="{{ $item->barang->gambar_url ?? asset('images/no-image.svg') }}" class="table-thumb" alt="">
                                        <span>{{ $item->barang->nama_barang ?? 'Produk sudah dihapus' }}</span>
                                    </td>
                                    <td class="angka">Rp {{ number_format($item->barang->harga ?? 0, 0, ',', '.') }}</td>
                                    <td class="angka">{{ $item->jumlah }}</td>
                                    <td class="angka td-strong">{{ $item->subtotal_format }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body" style="border-top:1px solid var(--color-border); padding-top:16px;">
                    <div class="summary-row total">
                        <span>Total Pesanan</span>
                        <span class="v">{{ $transaksi->total_harga_format }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stack-md">
            <div class="card">
                <div class="card-header"><h2 class="card-title">Info Pelanggan</h2></div>
                <div class="card-body stack-sm" style="font-size:14px;">
                    <div><x-icon name="user" class="w-4 h-4" style="vertical-align:-3px; color:var(--color-ink-muted);" /> {{ $transaksi->pelanggan->nama ?? '—' }}</div>
                    <div><x-icon name="phone" class="w-4 h-4" style="vertical-align:-3px; color:var(--color-ink-muted);" /> {{ $transaksi->pelanggan->no_hp ?? '—' }}</div>
                    <div><x-icon name="map-pin" class="w-4 h-4" style="vertical-align:-3px; color:var(--color-ink-muted);" /> {{ $transaksi->pelanggan->alamat ?? '—' }} ({{ $transaksi->pelanggan->kode_pos ?? '—' }})</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2 class="card-title">Info Pesanan</h2></div>
                <div class="card-body stack-sm" style="font-size:14px;">
                    <div class="flex-between"><span class="text-muted">Tanggal</span><span class="td-strong">{{ $transaksi->tanggal_transaksi?->translatedFormat('d F Y') }}</span></div>
                    <div class="flex-between"><span class="text-muted">Metode Pembayaran</span><span class="td-strong">{{ $transaksi->metode_pembayaran === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank' }}</span></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2 class="card-title">Perbarui Status</h2></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.transaksi.update', $transaksi) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-control">
                                @foreach (['diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $value => $label)
                                    <option value="{{ $value }}" @selected($transaksi->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Status</button>
                    </form>

                    <form method="POST" action="{{ route('admin.transaksi.destroy', $transaksi) }}"
                          data-confirm="Hapus transaksi ini secara permanen? Jika status belum dibatalkan, stok barang akan dikembalikan."
                          style="margin-top:10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">Hapus Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
