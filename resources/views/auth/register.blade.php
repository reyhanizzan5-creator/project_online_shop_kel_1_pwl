@extends('layout.auth')

@section('title', 'Daftar Akun')

@section('content')
    <h1>Buat akun baru</h1>
    <p class="subtitle">Isi semua data sesuai ketentuan.</p>

    <form method="POST" action="{{ route('register.store') }}" class="stack-md" novalidate>
        @csrf

        <div class="form-group">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama') }}" placeholder="Nama lengkap Anda" autofocus required>
            @error('nama') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="Tanpa spasi, contoh: budi123" required>
            @error('username') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-field">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 6 karakter" required>
                    <button type="button" class="password-toggle" data-target="password">Lihat</button>
                </div>
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div class="password-field">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="Ulangi password" required>
                    <button type="button" class="password-toggle" data-target="password_confirmation">Lihat</button>
                </div>
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                       value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="text" id="kode_pos" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror"
                       value="{{ old('kode_pos') }}" placeholder="Contoh: 40123" required>
                @error('kode_pos') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                      placeholder="Nama jalan, nomor rumah, kelurahan, kecamatan, kota" required>{{ old('alamat') }}</textarea>
            @error('alamat') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
    </form>

    <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
@endsection
