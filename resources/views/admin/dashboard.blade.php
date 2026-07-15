@extends('layout.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Statistik Online-Shop')

@section('content')

    <div class="stat-grid">
        <div class="stat-card tone-nila">
            <div class="stat-icon"><x-icon name="tag" class="w-4 h-4" /></div>
            <div class="stat-value angka">{{ $totalKategori }}</div>
            <div class="stat-label">Kategori</div>
        </div>
        <div class="stat-card tone-kunyit">
            <div class="stat-icon"><x-icon name="box" class="w-4 h-4" /></div>
            <div class="stat-value angka">{{ $totalBarang }}</div>
            <div class="stat-label">Produk</div>
        </div>
        <div class="stat-card tone-pandan">
            <div class="stat-icon"><x-icon name="users" class="w-4 h-4" /></div>
            <div class="stat-value angka">{{ $totalPelanggan }}</div>
            <div class="stat-label">Pelanggan</div>
        </div>
        <div class="stat-card tone-bahaya">
            <div class="stat-icon"><x-icon name="wallet" class="w-4 h-4" /></div>
            <div class="stat-value angka" style="font-size:19px;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan ({{ $totalTransaksi }} transaksi)</div>
        </div>
    </div>

    <div class="admin-grid-2">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Transaksi Terbaru</h2>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body" style="padding-top:8px; padding-bottom:8px;">
                @forelse ($transaksiTerbaru as $trx)
                    <div class="mini-list-row">
                        <div>
                            <div class="judul">{{ $trx->pelanggan->nama ?? '—' }}</div>
                            <div class="sub">{{ $trx->tanggal_transaksi?->translatedFormat('d M Y') }}</div>
                        </div>
                        <div class="flex" style="align-items:center; gap:10px;">
                            <span class="angka" style="font-weight:700; font-size:13.5px;">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</span>
                            <span class="{{ $trx->status_badge_class }}">{{ $trx->status_label }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-muted" style="padding:20px 0;">Belum ada transaksi masuk.</p>
                @endforelse
            </div>
        </div>

        <div class="stack-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Stok Menipis</h2>
                </div>
                <div class="card-body" style="padding-top:8px; padding-bottom:8px;">
                    @forelse ($barangStokMenipis as $barang)
                        <div class="mini-list-row">
                            <div class="judul">{{ $barang->nama_barang }}</div>
                            <span class="badge badge-red">{{ $barang->stok }} tersisa</span>
                        </div>
                    @empty
                        <p class="text-muted" style="padding:20px 0;">Semua stok produk aman.</p>
                    @endforelse
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Produk Terlaris</h2>
                </div>
                <div class="card-body" style="padding-top:8px; padding-bottom:8px;">
                    @forelse ($produkTerlaris as $item)
                        <div class="mini-list-row">
                            <div class="judul">{{ $item->barang->nama_barang ?? 'Produk dihapus' }}</div>
                            <span class="badge badge-blue">{{ $item->total_terjual }} terjual</span>
                        </div>
                    @empty
                        <p class="text-muted" style="padding:20px 0;">Belum ada data penjualan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
