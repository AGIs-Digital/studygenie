<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AssetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        URL::macro('versioned', function ($path) {
            $version = config('assets.version');
            return asset($path) . '?v=' . $version;
        });
    }
}
