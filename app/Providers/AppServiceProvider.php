<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // <--- 2. TAMBAHKAN KODE INI
        // Memaksa HTTPS jika aplikasi berjalan di Production atau Ngrok
        if($this->app->environment('production') || str_contains(request()->header('Host'), 'ngrok')) {
            URL::forceScheme('https');
        }
    }
}
