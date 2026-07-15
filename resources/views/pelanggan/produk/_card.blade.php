<div class="product-card">
    <a href="{{ route('pelanggan.produk.show', $barang) }}">
        <div class="product-photo">
            <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama_barang }}" loading="lazy">
            @if ($barang->stok <= 0)
                <span class="stok-badge badge badge-red">Stok Habis</span>
            @elseif ($barang->stok_menipis)
                <span class="stok-badge badge badge-yellow">Sisa {{ $barang->stok }}</span>
            @endif
        </div>
    </a>
    <div class="product-card-body">
        <span class="eyebrow-kategori">{{ $barang->kategori->nama_kategori ?? 'Umum' }}</span>
        <a href="{{ route('pelanggan.produk.show', $barang) }}" style="color:inherit;">
            <div class="nama-produk">{{ $barang->nama_barang }}</div>
        </a>
        <div class="harga">{{ $barang->harga_format }}</div>
    </div>
    <div class="product-card-footer">
        @if ($barang->stok > 0)
            <form method="POST" action="{{ route('pelanggan.keranjang.store') }}" data-add-cart>
                @csrf
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                <input type="hidden" name="jumlah" value="1">
                <button type="submit" class="btn btn-primary btn-sm btn-block">
                    <x-icon name="cart" class="w-4 h-4" /> Tambah
                </button>
            </form>
        @else
            <button type="button" class="btn btn-outline btn-sm btn-block" disabled>Stok Habis</button>
        @endif
    </div>
</div>
