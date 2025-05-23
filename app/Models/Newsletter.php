<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'subject',
        'content',
        'preview_html',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];
} 