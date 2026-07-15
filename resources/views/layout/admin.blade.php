<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin Online-Shop</title>
    <link rel="icon" href="{{ asset('images/no-image.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="admin-shell">
        <div class="sidebar-scrim"></div>

        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <div class="brand-mark"><span class="dot"></span> Online-Shop</div>
                <div class="brand-sub">Dashboard Admin</div>
            </div>

            <nav class="admin-nav">
                <div class="admin-nav-label">Menu</div>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <x-icon name="dashboard" class="w-4 h-4" /> Dashboard
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'is-active' : '' }}">
                    <x-icon name="tag" class="w-4 h-4" /> Kategori
                </a>
                <a href="{{ route('admin.barang.index') }}" class="{{ request()->routeIs('admin.barang.*') ? 'is-active' : '' }}">
                    <x-icon name="box" class="w-4 h-4" /> Produk
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->routeIs('admin.transaksi.*') ? 'is-active' : '' }}">
                    <x-icon name="receipt" class="w-4 h-4" /> Transaksi
                </a>
                <a href="{{ route('admin.pelanggan.index') }}" class="{{ request()->routeIs('admin.pelanggan.*') ? 'is-active' : '' }}">
                    <x-icon name="users" class="w-4 h-4" /> Pelanggan
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <div class="admin-user-chip">
                    <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="admin-user-info">
                        <div class="nama">{{ auth()->user()->name }}</div>
                        <div class="peran">Admin</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn admin-logout-btn btn-sm">
                        <x-icon name="logout" class="w-4 h-4" /> Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div class="flex" style="align-items:center; gap:14px;">
                    <button type="button" class="admin-sidebar-toggle" data-sidebar-toggle aria-label="Buka menu">
                        <x-icon name="menu" class="w-5 h-5" />
                    </button>
                    <div>
                        <h1>@yield('title', 'Dashboard')</h1>
                        @hasSection('breadcrumb')
                            <div class="breadcrumb">@yield('breadcrumb')</div>
                        @endif
                    </div>
                </div>
                <div class="text-muted" style="font-size:13px;">{{ now()->translatedFormat('l, d F Y') }}</div>
            </header>

            <main class="admin-content">
                <div class="container" style="padding-inline:0; max-width:100%;">
                    @include('partials.flash')
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('partials.confirm-modal')

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
