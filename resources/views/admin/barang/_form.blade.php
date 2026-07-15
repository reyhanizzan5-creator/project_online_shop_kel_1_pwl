<div class="form-group">
    <label class="form-label">Foto Produk <span class="opsional">(opsional)</span></label>
    <div class="upload-preview">
        <img id="preview-gambar" src="{{ isset($barang) ? $barang->gambar_url : asset('images/no-image.svg') }}" class="upload-preview-img" alt="Pratinjau">
        <label class="upload-dropzone" style="flex:1;">
            <x-icon name="image" class="w-5 h-5" style="margin:0 auto 6px;" />
            <div style="font-size:13px; font-weight:600;">Klik untuk {{ isset($barang) ? 'ganti' : 'unggah' }} gambar</div>
            <div class="form-hint" style="margin-top:2px;">JPG, PNG, atau WEBP. Maks 2MB.</div>
            <input type="file" name="gambar" accept="image/*" data-image-input="#preview-gambar">
        </label>
    </div>
    @error('gambar') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="nama_barang" class="form-label">Nama Produk</label>
    <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
           value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" placeholder="Contoh: Headset Bluetooth JBL Tune 510BT" required autofocus>
    @error('nama_barang') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="kategori_id" class="form-label">Kategori</label>
    <select id="kategori_id" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
        <option value="">Pilih kategori…</option>
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}" @selected(old('kategori_id', $barang->kategori_id ?? null) == $kategori->id)>{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select>
    @error('kategori_id') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-grid-2">
    <div class="form-group">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" min="0" step="1" class="form-control @error('harga') is-invalid @enderror"
               value="{{ old('harga', $barang->harga ?? '') }}" placeholder="0" required>
        @error('harga') <div class="form-error">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" id="stok" name="stok" min="0" step="1" class="form-control @error('stok') is-invalid @enderror"
               value="{{ old('stok', $barang->stok ?? '') }}" placeholder="0" required>
        @error('stok') <div class="form-error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="flex gap-sm" style="margin-top:8px;">
    <button type="submit" class="btn btn-primary">{{ isset($barang) ? 'Simpan Perubahan' : 'Tambah Produk' }}</button>
    <a href="{{ route('admin.barang.index') }}" class="btn btn-outline">Batal</a>
</div>
