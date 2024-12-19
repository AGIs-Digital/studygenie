<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use SerializesModels;

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
        return $this->from(config('mail.newsletter.address'), config('mail.newsletter.name'))
                    ->subject($this->subject)
                    ->view('emails.newsletter');
    }
} 