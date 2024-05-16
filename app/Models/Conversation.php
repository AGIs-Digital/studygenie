<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Custom\Prompt;

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
     * Überschreibt die save Methode. Wenn es sich um eine neue Konversation handelt oder die
     * Converation keine Nachrichten enthält, wird die erste Nachricht erstellt.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $isNew = !$this->exists;

        // Speichere zuerst die Konversation, um eine ID zu erhalten
        $saved = parent::save($options);

        // if its a new conversation without any messages, we need to create the first message
        if ($saved && $this->messages->count() === 0)
        {
            $message = $this->messages()->create([
                'user_id' => $this->user_id,
                'content' => $this->loadFirstMessagePrompt(['replacements' => ['username' => auth()->user()->name]]),
                'role' => 'assistant'
            ]);
        }

        return $saved;
    }

    /**
     * Lädt den Systemprompt für die Konversation and hand des Tool Identifiers.
     */
    public function loadSystemPrompt($params)
    {
        // load the system prompt for the conversation from config
        $prompt = new Prompt('prompts.' . $this->tool_identifier . '.system_prompt');

        if (isset($params['replacements'])) {
            foreach ($params['replacements'] as $placeholder => $replacement) {
                $prompt->replace($placeholder, $replacement);
            }
        }

        return $prompt->get();
    }

    /**
     * Lädt den Systemprompt für die Konversation and hand des Tool Identifiers.
     */
    public function loadFirstMessagePrompt($params)
    {
        // load the system prompt for the conversation from config
        $prompt = new Prompt(config('prompts.' . $this->tool_identifier . '.first_message'));

        if (isset($params['replacements'])) {
            foreach ($params['replacements'] as $placeholder => $replacement) {
                $prompt->replace($placeholder, $replacement);
            }
        }

        return $prompt->get();
    }


    /**
     * Erstellt ein Payload für die OpenAI API.
     */
    public function createPayload()
    {
        $globalSystemPrompt = config('prompts.system_prompt');
        $contextualSystemPrompt = $this->loadSystemPrompt(['replacements' => ['username' => auth()->user()->name]]);

        $systemPrompt = $globalSystemPrompt . "\n" . $contextualSystemPrompt;

        $messages = $this->messages()->orderBy('created_at', 'asc')->get();
        $messages = $messages->map(function ($message) {
            return [
                "role" => $message->role,
                "content" => $message->content
            ];
        });

        # add system prompt as last message
        $messages->push([
            "role" => "system",
            "content" => $systemPrompt
        ]);

        $payload = [
            'model' => config('openai.preferred_model'),
            'messages' => $messages
        ];

        return $payload;

    }
}
