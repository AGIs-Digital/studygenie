<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CloudContent extends Component
{
    public $toolName;
    public $bgColor;
    public $textColor;

    public function __construct($toolName, $bgColor = '#E09E50', $textColor = '#FFFFFF')
    {
        $this->toolName = $toolName;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
    }

    public function render()
    {
        return view('components.cloud-content');
    }
} 