<?php
namespace App\Custom;

use Illuminate\Support\Facades\Config;

class Prompt
{
    // The prompt identifier in the config file
    private $prompt_identifier;

    // The prompt string
    private $prompt;

    public function __construct($prompt_identifier)
    {
        $this->prompt_identifier = $prompt_identifier;
        $this->prompt = Config::get($prompt_identifier);
    }

    public function replace($placeholder, $replacement)
    {
        $this->prompt = str_replace('{{' . $placeholder . '}}', $replacement, $this->prompt);
    }

    public function get()
    {
        return $this->prompt;
    }
}
