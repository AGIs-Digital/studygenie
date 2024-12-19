<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmailLogo extends Component
{
    public function render()
    {
        $path = public_path('asset/images/Logo_(2).png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = base64_encode($data);
        
        return "data:image/$type;base64,$base64";
    }
} 