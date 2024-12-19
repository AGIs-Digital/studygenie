<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\User;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function create()
    {
        return view('admin.newsletter.create');
    }

    public function preview(Request $request)
    {
        $subject = $request->input('subject');
        $content = $request->input('content');

        // Optional: Hier können Sie die E-Mail-Template-Ansicht rendern
        return view('emails.newsletter', [
            'subject' => $subject,
            'content' => $content
        ])->render();
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $newsletter = Newsletter::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'preview_html' => view('emails.newsletter', [
                'subject' => $request->subject,
                'content' => $request->content,
                'unsubscribe_token' => 'preview'
            ])->render()
        ]);

        $subscribers = User::where(function($query) {
            $query->where('newsletter_subscribed', true)
                  ->orWhereNull('newsletter_subscribed');
        })
        ->whereNull('newsletter_unsubscribed_at')
        ->cursor();

        foreach ($subscribers as $user) {
            if (!$user->newsletter_token) {
                $user->update(['newsletter_token' => Str::random(32)]);
            }

            Mail::to($user->email)->queue(new NewsletterMail(
                $newsletter->subject,
                $newsletter->content,
                $user->newsletter_token
            ));
        }

        $newsletter->update(['sent_at' => now()]);

        return redirect()->back()->with('success', 'Newsletter wurde erfolgreich versendet!');
    }

    public function unsubscribe($token)
    {
        $user = User::where('newsletter_token', $token)->firstOrFail();
        $user->update([
            'newsletter_subscribed' => false,
            'newsletter_unsubscribed_at' => now()
        ]);

        return redirect()->route('home')
            ->with('success', 'Du wurdest erfolgreich vom Newsletter abgemeldet.');
    }
} 