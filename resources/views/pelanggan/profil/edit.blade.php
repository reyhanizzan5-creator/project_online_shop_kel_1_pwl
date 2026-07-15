@extends('layout.pelanggan')

@section('title', 'Profil Saya')

@section('content')

    <div class="profile-header">
        <div class="profile-avatar">{{ strtoupper(substr($pelanggan->nama, 0, 1)) }}</div>
        <div>
            <h1 style="font-size:20px; margin-bottom:2px;">{{ $pelanggan->nama }}</h1>
            <div class="text-muted" style="font-size:13.5px;">Username: {{ $pelanggan->user->username ?? '—' }}</div>
        </div>
    </div>

    <div class="card" style="max-width:640px;">
        <div class="card-body">
            <form method="POST" action="{{ route('pelanggan.profil.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pelanggan->nama) }}" required>
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

                <hr style="border:none; border-top:1px solid var(--color-border); margin:22px 0;">

                <p class="form-label" style="margin-bottom:14px;">Ubah Password <span class="opsional">(kosongkan jika tidak ingin mengubah)</span></p>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="password_baru" class="form-label">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Minimal 6 karakter">
                        @error('password_baru') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" class="form-control" placeholder="Ulangi password baru">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top:8px;">Simpan Perubahan</button>
            </form>
        </div>
    </div>

@endsection
