@extends('layout.auth')

@section('title', 'Masuk')

@section('content')
    <h1>Selamat Datang!!</h1>
    <p class="subtitle">Masukkan Username dan Password Anda untuk Login.</p>

    <form method="POST" action="{{ route('login.attempt') }}" class="stack-md" novalidate>
        @csrf

        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="Masukkan username" autofocus required>
            @error('username')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-field">
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password" required>
                <button type="button" class="password-toggle" data-target="password">Lihat</button>
            </div>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <label class="flex" style="align-items:center; gap:8px; font-size:13.5px; color:var(--color-ink-muted); cursor:pointer;">
            <input type="checkbox" name="remember" style="accent-color:var(--color-nila); width:16px; height:16px;">
            Ingat saya di perangkat ini
        </label>

        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </form>

    <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection
