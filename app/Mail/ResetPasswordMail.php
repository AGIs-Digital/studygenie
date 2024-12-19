<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use SerializesModels;

    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->from(config('mail.noreply.address'), config('mail.noreply.name'))
                    ->subject('Passwort zurücksetzen')
                    ->markdown('emails.password_reset');
    }
} 