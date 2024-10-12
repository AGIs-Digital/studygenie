<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class AssetHelper
{
    public static function version($path)
    {
        if (app()->environment('local')) {
            return asset($path);
        }

        $manifestPath = public_path('mix-manifest.json');

        if (!File::exists($manifestPath)) {
            return asset($path);
        }

        $manifest = json_decode(File::get($manifestPath), true);
        $path = "/{$path}";

        if (!array_key_exists($path, $manifest)) {
            return asset($path);
        }

        return asset($manifest[$path]);
    }
}

