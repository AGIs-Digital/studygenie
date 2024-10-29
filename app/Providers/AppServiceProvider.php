<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/AssetHelper.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Generiere einen eindeutigen Hash basierend auf dem Release-Tag
        $version = config('app.version', md5(time())); 
        
        // Füge Version zu allen Asset-URLs hinzu
        \URL::macro('versioned', function ($path) use ($version) {
            return url($path) . '?v=' . $version;
        });
    }
}
