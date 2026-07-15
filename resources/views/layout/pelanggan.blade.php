<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') — Online-Shop</title>
    <link rel="icon" href="{{ asset('images/no-image.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>
    @php $pelangganAktif = auth()->user()->pelanggan; @endphp

    <header class="shop-navbar">
        <div class="container shop-navbar-inner">
            <a href="{{ route('pelanggan.dashboard') }}" class="shop-brand">
                <span class="dot"></span> Online-Shop
            </a>

            <nav class="shop-nav-links">
                <a href="{{ route('pelanggan.dashboard') }}" class="{{ request()->routeIs('pelanggan.dashboard') ? 'is-active' : '' }}">
                    <x-icon name="dashboard" class="w-4 h-4" /> Beranda
                </a>
                <a href="{{ route('pelanggan.produk.index') }}" class="{{ request()->routeIs('pelanggan.produk.*') ? 'is-active' : '' }}">
                    <x-icon name="box" class="w-4 h-4" /> Produk
                </a>
                <a href="{{ route('pelanggan.keranjang.index') }}" class="{{ request()->routeIs('pelanggan.keranjang.*') || request()->routeIs('pelanggan.checkout*') ? 'is-active' : '' }}" style="position:relative;">
                    <x-icon name="cart" class="w-4 h-4" /> Keranjang
                    <span class="cart-badge {{ ($pelangganAktif->jumlah_item_keranjang ?? 0) < 1 ? 'hidden' : '' }}" data-cart-badge>{{ $pelangganAktif->jumlah_item_keranjang ?? 0 }}</span>
                </a>
                <a href="{{ route('pelanggan.transaksi.index') }}" class="{{ request()->routeIs('pelanggan.transaksi.*') ? 'is-active' : '' }}">
                    <x-icon name="receipt" class="w-4 h-4" /> Riwayat
                </a>
                <a href="{{ route('pelanggan.profil.edit') }}" class="{{ request()->routeIs('pelanggan.profil.*') ? 'is-active' : '' }}">
                    <x-icon name="user" class="w-4 h-4" /> Profil
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin-left:4px;">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm"><x-icon name="logout" class="w-4 h-4" /> Keluar</button>
                </form>
            </nav>

            <button type="button" class="shop-nav-toggle" data-shop-nav-toggle aria-label="Buka menu">
                <x-icon name="menu" class="w-5 h-5" />
            </button>
        </div>
    </header>

    <main class="container" style="padding-top:22px; padding-bottom:48px; min-height:70vh;">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="shop-footer">
        <div class="container">
            &copy; {{ date('Y') }} {{ config('app.name', 'Etalase') }} &middot; Belanja praktis, murah, dan terpercaya.
        </div>
    </footer>

    @include('partials.confirm-modal')

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
