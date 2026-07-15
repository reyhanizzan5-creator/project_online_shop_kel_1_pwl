<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk') — {{ config('app.name', 'Etalase') }}</title>
    <link rel="icon" href="{{ asset('images/no-image.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>

    <div class="auth-shell">
        <div class="auth-brand-panel">
            <div class="auth-brand-mark">
                <span class="dot"></span>
                Online-Shop
            </div>

            <div class="auth-brand-quote">
                <p>&ldquo;{{ $quote ?? 'Belanja semua kebutuhan belanjamu — elektronik, fashion, hinggan kebutuhan dapur.' }}&rdquo;</p>
                <span>Belanja praktis, murah, dan terpercaya.</span>
            </div>

            <div class="auth-brand-foot">
                &copy; Online Shop
            </div>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-box">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
