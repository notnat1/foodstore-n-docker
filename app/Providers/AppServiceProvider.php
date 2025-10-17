<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;             // ← tambahkan
use Illuminate\Http\Request;                   // ← jika perlu

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Jika aplikasi berjalan di lingkungan selain "local", aktifkan HTTPS
        if (app()->environment('production')) {
            // Ini akan memaksa semua URL asset, route, dll. menggunakan HTTPS
            URL::forceScheme('https');
        }

        // Alternatif: selalu paksa HTTPS, tanpa pedulikan environment
        // URL::forceScheme('https');
    }
}


// <!-- <?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         //
//     }
// } -->
