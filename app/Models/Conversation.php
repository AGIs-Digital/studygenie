<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tool_identifier',
    ];

    /**
     * Ein Conversation gehört zu einem User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eine Conversation hat mehrere Messages.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Setzt die Konversation zurück, indem alle zugehörigen Nachrichten gelöscht werden.
     *
     * @return void
     */
    public function deleteMessages()
    {
        // Lösche alle Nachrichten, die zu dieser Konversation gehören
        DB::table('messages')->where('conversation_id', $this->id)->delete();
    }


    /**
     * Überschreibt die save Methode. Löscht Konversationen mit demselben User und Tool Identifier.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (!$this->exists) {
            // Es handelt sich um eine neue Konversation
            $existingConversation = self::where('user_id', $this->user_id)
                ->where('tool_identifier', $this->tool_identifier)
                ->first();

            if ($existingConversation) {
                // Lösche die alte Konversation und alle dazugehörigen Nachrichten
                $existingConversation->deleteMessages();

                // Lösche die Konversation selbst
                $existingConversation->delete();
            }
        }

        return parent::save($options);
    }
}
