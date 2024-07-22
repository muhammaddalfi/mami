<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RupiahServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/Rupiah.php';
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
