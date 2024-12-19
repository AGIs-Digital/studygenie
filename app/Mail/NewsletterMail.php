<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $unsubscribe_token;

    public function __construct($subject, $content, $unsubscribe_token)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->unsubscribe_token = $unsubscribe_token;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->markdown('emails.newsletter');
    }
} 