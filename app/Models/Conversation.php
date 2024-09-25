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
            // Check, if the config key exists
            if (!config('prompts.' . $this->tool_identifier . '.first_message')) {
                // Add log message
                \Log::warning('No first message prompt found for tool ' . $this->tool_identifier);
                return $saved;
            }

            $message = $this->messages()->create([
                'user_id' => $this->user_id,
                'content' => $this->loadFirstMessagePrompt(['replacements' => ['username' => auth()->user()->name]]),
                'role' => 'assistant'
            ]);
        }

        return $saved;
    }

    /**
     * Lädt den BasePrompt für die Konversation and hand des Tool Identifiers.
     */
    public function loadSystemPrompt($params)
    {
        // Check, if prompt exists. if not return empty string
        if (!config('prompts.' . $this->tool_identifier . '.base_prompt')) {
            return '';
        }

        // load the base prompt for the conversation from config
        $prompt = new Prompt('prompts.' . $this->tool_identifier . '.base_prompt');

        if (isset($params['replacements'])) {
            foreach ($params['replacements'] as $placeholder => $replacement) {
                $prompt->replace($placeholder, $replacement);
            }
        }

        return $prompt->get();
    }

    /**
     * Lädt den task prompt für die Konversation and hand des Tool Identifiers und ersetzt die als Parameter übergebene Replacements
     */
    public function loadTaskPrompt($params)
    {
        // Check, if prompt exists. if not return empty string
        if (!config('prompts.' . $this->tool_identifier . '.task_prompt')) {
            return '';
        }

        // load the task prompt for the conversation from config
        $prompt = new Prompt('prompts.' . $this->tool_identifier . '.task_prompt');

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
        $prompt = new Prompt('prompts.' . $this->tool_identifier . '.first_message');

        if (isset($params['replacements'])) {
            foreach ($params['replacements'] as $placeholder => $replacement) {
                $prompt->replace($placeholder, $replacement);
            }
        }

        return $prompt->get();
    }


    /**
     * Erstellt ein Payload für die OpenAI API.
     *
     * @param int $numberOfMessages
     * @return array
     */
    public function createPayload($numberOfMessages = 30): array
    {
        // Lade die Konfigurationen für das spezifische Tool oder verwende die Standardkonfiguration
        $toolConfig = config('openai.tools.' . $this->tool_identifier, config('openai.tools.default'));

        // Lade den globalen System-Prompt
        $globalSystemPrompt = new Prompt('prompts.system_prompt');
        $globalSystemPrompt->replace('username', auth()->user()->name);

        // Lade den tool-spezifischen System-Prompt
        $contextualSystemPrompt = $this->loadSystemPrompt(['replacements' => ['username' => auth()->user()->name]]);
        $systemPrompt = $globalSystemPrompt->get() . "\n" . $contextualSystemPrompt;

        // Lade alle Nachrichten der Konversation, begrenzt auf die letzten $numberOfMessages
        $messages = $this->messages()->orderBy('created_at', 'asc')->limit($numberOfMessages)->get();
        $messages = $messages->map(function ($message) {
            return [
                "role" => $message->role,
                "content" => $message->content
            ];
        });

        // Füge den System-Prompt als erste Nachricht hinzu
        $messages->push([
            "role" => "system",
            "content" => $systemPrompt
        ]);

        // Erstelle das Payload-Array
        $payload = [
            'model' => $toolConfig['model'],
            'messages' => $messages,
        ];

        return $payload;
    }
}
