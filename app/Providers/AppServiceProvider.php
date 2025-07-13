<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Publish Bootstrap assets (e.g., config files, views, etc.)
        $this->publishes([
            __DIR__ . '/../resources/assets/bootstrap' => public_path('vendor/bootstrap'),
        ], 'bootstrap-assets');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configure pagination to use Bootstrap
        Paginator::useBootstrap();
    }
}
