<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- TAMBAHKAN BARIS INI

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
        // TAMBAHKAN KODE INI:
        // Jika APP_URL di .env dimulai dengan 'https', paksa semua link jadi https
        if (str_contains(config('app.url'), 'https')) {
            URL::forceScheme('https');
        }
    }
}
