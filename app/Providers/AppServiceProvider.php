<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        Authenticate::redirectUsing(function () {
            return route('login');
        });

        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();

            return $user && $user->role === 'admin'
                ? route('admin.dashboard')
                : route('pelanggan.dashboard');
        });

        Paginator::defaultView('pagination.custom');
        Paginator::defaultSimpleView('pagination.custom');
    }
}
