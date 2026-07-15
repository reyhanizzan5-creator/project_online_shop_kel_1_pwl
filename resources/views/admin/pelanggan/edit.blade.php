@extends('layout.admin')

@section('title', 'Ubah Pelanggan')
@section('breadcrumb', 'Pelanggan / Ubah')

@section('content')
    <div class="card" style="max-width:680px;">
        <div class="card-body">
            <div class="form-hint" style="margin-bottom:18px;">Username: <strong class="text-muted">{{ $pelanggan->user->username ?? '—' }}</strong> (tidak dapat diubah di sini)</div>

            <form method="POST" action="{{ route('admin.pelanggan.update', $pelanggan) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pelanggan->nama) }}" required autofocus>
                    @error('nama') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $pelanggan->no_hp) }}" required>
                        @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="text" id="kode_pos" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" value="{{ old('kode_pos', $pelanggan->kode_pos) }}" required>
                        @error('kode_pos') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="flex gap-sm" style="margin-top:8px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
