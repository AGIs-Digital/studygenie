<?php
namespace App\Custom;

use Illuminate\Support\Facades\Config;

class Prompt
{
    private $prompt;

    public function __construct($prompt)
    {
        $this->prompt = $prompt;
    }

    public function replace($placeholder, $replacement)
    {
        $this->prompt = str_replace($placeholder, $replacement, $this->prompt);
    }

    public function get()
    {
        return $this->prompt;
    }
}
