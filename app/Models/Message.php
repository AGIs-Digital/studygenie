<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'content',
        'conversation_id',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    # setter for content
    public function setContentAttribute($value)
    {
        # format content
        // Replace "**text**" with "<b>text</b>" and linebreaks with "<br>"
        $value = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $value);
        $value = str_replace("\n", "<br>", $value);

        $this->attributes['content'] = $value;
    }

    /**
     * Method, to replace placeholders in the messages' content
     * placeholders look like {{placeholder}}
     *
     * @param string $placeholder
     * @param string $replacement
     */
    public function replacePlaceholder($placeholder, $replacement = '', $defaultReplacement = '')
    {
        $placeholder = '{{' . $placeholder . '}}';

        # if is '' or not type string
        if ($replacement === '' || gettype($replacement) !== 'string') {
            $replacement = $defaultReplacement;
        }
        $this->content = str_replace($placeholder, $replacement, $this->content);
    }
}
