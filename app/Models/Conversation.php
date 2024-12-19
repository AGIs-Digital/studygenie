<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Custom\Prompt;
use OpenAI\Laravel\Facades\OpenAI;

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
        $saved = parent::save($options);
        
        if ($saved) {
            $user = auth()->user();
            $greetingColumn = 'last_' . $this->tool_identifier . '_greeting_at';
            $lastGreeting = $user->$greetingColumn;
            $today = now()->startOfDay();
            
            // Prüfe ob heute schon eine Begrüßung für dieses Tool stattfand
            if (!$lastGreeting || $lastGreeting->startOfDay()->lt($today)) {
                $message = $this->messages()->create([
                    'user_id' => $this->user_id,
                    'content' => $this->loadFirstMessagePrompt(['replacements' => ['username' => $user->name]]),
                    'role' => 'assistant'
                ]);
                
                // Aktualisiere den Zeitstempel der letzten Begrüßung für dieses Tool
                $user->update([$greetingColumn => now()]);
            }
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

        // Füge Zeitinformationen zu den Replacements hinzu
        $now = now()->setTimezone('Europe/Berlin');
        $params['replacements']['current_time'] = $now->format('H:i');
        $params['replacements']['current_date'] = $now->format('d.m.Y');
        $params['replacements']['weekday'] = trans('dates.days.' . $now->format('l'));
        $params['replacements']['is_holiday'] = $this->getSpecialDay($now) ? 'true' : 'false';

        return $prompt->get();
    }

    /**
     * Lädt den Systemprompt für die Konversation and hand des Tool Identifiers.
     */
    public function loadFirstMessagePrompt($params)
    {
        try {
            $greetingContext = $this->getGreetingContext();
            
            // Erstelle einen Prompt für die KI
            $systemPrompt = "Generiere eine freundliche, personalisierte Begrüßung für den Benutzer. " .
                "Berücksichtige folgende Informationen:\n" .
                "- Tageszeit: {$greetingContext['time_greeting']} {$greetingContext['time_emoji']}\n" .
                "- Benutzername: {$greetingContext['username']}\n" .
                "- Jahreszeit: {$greetingContext['season']} {$greetingContext['season_emoji']}\n";
                
            if ($greetingContext['special_day']) {
                $systemPrompt .= "- Besonderer Tag: {$greetingContext['special_day']} {$greetingContext['special_emoji']}\n";
            }
            
            if ($greetingContext['last_conversation']) {
                $systemPrompt .= "- Letzter Besuch: {$greetingContext['last_conversation']}\n";
            }
            
            $systemPrompt .= "\nDie Begrüßung sollte freundlich, jugendlich und einladend sein. ";
            $systemPrompt .= "Verwende die angegebenen Emojis in der Begrüßung. ";
            $systemPrompt .= "Wenn es ein besonderer Tag oder Ferienzeit ist, beziehe dies motivierend in die Begrüßung ein.";
            
            // OpenAI API aufrufen für personalisierte Begrüßung
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => 'Generiere eine passende Begrüßung.']
                ],
                'temperature' => 1.0
            ]);

            return $response->choices[0]->message->content;

        } catch (\Exception $e) {
            \Log::error('Fehler bei der Generierung der Begrüßung: ' . $e->getMessage());
            
            // Fallback-Begrüßung mit Emoji
            return "👋 Hallo {$params['replacements']['username']}, wie kann ich dir helfen?";
        }
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

        // Füge Zeitinformationen hinzu
        $now = now();
        $globalSystemPrompt->replace('current_time', $now->format('H:i'));
        $globalSystemPrompt->replace('current_date', $now->format('d.m.Y'));
        $globalSystemPrompt->replace('weekday', trans('dates.days.' . $now->format('l')));
        $globalSystemPrompt->replace('season', match($now->month) {
            12, 1, 2 => 'Winter',
            3, 4, 5 => 'Frühling',
            6, 7, 8 => 'Sommer',
            9, 10, 11 => 'Herbst',
        });

        // Lade den tool-spezifischen System-Prompt
        $contextualSystemPrompt = $this->loadSystemPrompt(['replacements' => ['username' => auth()->user()->name]]);
        $systemPrompt = $globalSystemPrompt->get() . "\n" . $contextualSystemPrompt;

        // Lade alle Nachrichten der Konversation, begrenzt auf die letzten $numberOfMessages
        $messages = $this->messages()->orderBy('created_at', 'desc')->limit($numberOfMessages)->get();

        // Reihenfolge der Nachrichten umkehren um die Nachrichten in chronologischer Reihenfolge zu erhalten
        $messages = $messages->reverse()->values();
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

    /**
     * Prüft auf Feiertage und besondere Tage
     */
    private function getSpecialDay(\Carbon\Carbon $date): ?array
    {
        $month = $date->month;
        $day = $date->day;

        // Feste Feiertage mit Emojis
        $fixedHolidays = [
            '1-1' => ['type' => 'new_year', 'emoji' => '🎊'],
            '2-14' => ['type' => 'valentines_day', 'emoji' => '❤️'],
            '3-8' => ['type' => 'womens_day', 'emoji' => '👩'],
            '5-1' => ['type' => 'labor_day', 'emoji' => '👷'],
            '10-3' => ['type' => 'german_unity_day', 'emoji' => '🇩🇪'],
            '10-31' => ['type' => 'halloween', 'emoji' => '🎃'],
            '11-11' => ['type' => 'carnival_start', 'emoji' => '🎭'],
            '12-6' => ['type' => 'st_nicholas_day', 'emoji' => '🎅'],
            '12-24' => ['type' => 'christmas_eve', 'emoji' => '🎄'],
            '12-25' => ['type' => 'christmas_day', 'emoji' => '🎁'],
            '12-26' => ['type' => 'boxing_day', 'emoji' => '🎄'],
            '12-31' => ['type' => 'new_years_eve', 'emoji' => '🎆'],
        ];

        // Prüfe feste Feiertage
        $dateKey = $month . '-' . $day;
        if (isset($fixedHolidays[$dateKey])) {
            return $fixedHolidays[$dateKey];
        }

        // Ferien (ungefähre Zeiträume - kann je nach Bundesland variieren)
        $holidays = [
            // Winterferien
            ['start' => '12-23', 'end' => '01-06', 'type' => 'winter_holidays', 'emoji' => '⛄'],
            // Osterferien (ca.)
            ['start' => '03-27', 'end' => '04-14', 'type' => 'easter_holidays', 'emoji' => '🐰'],
            // Pfingstferien (ca.)
            ['start' => '05-22', 'end' => '06-02', 'type' => 'pentecost_holidays', 'emoji' => '🌺'],
            // Sommerferien (ca.)
            ['start' => '07-01', 'end' => '09-10', 'type' => 'summer_holidays', 'emoji' => '🌞'],
            // Herbstferien (ca.)
            ['start' => '10-15', 'end' => '10-30', 'type' => 'autumn_holidays', 'emoji' => '🍂'],
        ];

        // Prüfe Ferienzeiten
        foreach ($holidays as $holiday) {
            $start = \Carbon\Carbon::createFromFormat('m-d', $holiday['start'])->month * 100 + 
                    \Carbon\Carbon::createFromFormat('m-d', $holiday['start'])->day;
            $end = \Carbon\Carbon::createFromFormat('m-d', $holiday['end'])->month * 100 + 
                   \Carbon\Carbon::createFromFormat('m-d', $holiday['end'])->day;
            $current = $month * 100 + $day;

            if ($start <= $current && $current <= $end) {
                return ['type' => $holiday['type'], 'emoji' => $holiday['emoji']];
            }
        }

        // Bewegliche Feiertage berechnen
        $year = $date->year;
        $easter = new \DateTime("$year-03-21");
        $easter->modify('+' . easter_days($year) . ' days');
        
        // Bewegliche Feiertage basierend auf Ostern mit Emojis
        $movableHolidays = [
            'carnival_thursday' => ['offset' => -52, 'emoji' => '🎭'],
            'carnival_monday' => ['offset' => -48, 'emoji' => '🎭'],
            'carnival_tuesday' => ['offset' => -47, 'emoji' => '🎭'],
            'ash_wednesday' => ['offset' => -46, 'emoji' => '✝️'],
            'palm_sunday' => ['offset' => -7, 'emoji' => '🌿'],
            'maundy_thursday' => ['offset' => -3, 'emoji' => '🍞'],
            'good_friday' => ['offset' => -2, 'emoji' => '✝️'],
            'easter_sunday' => ['offset' => 0, 'emoji' => '🐣'],
            'easter_monday' => ['offset' => 1, 'emoji' => '🐰'],
            'ascension_day' => ['offset' => 39, 'emoji' => '☁️'],
            'pentecost_sunday' => ['offset' => 49, 'emoji' => '🕊️'],
            'pentecost_monday' => ['offset' => 50, 'emoji' => '🕊️'],
            'corpus_christi' => ['offset' => 60, 'emoji' => '✝️'],
        ];

        foreach ($movableHolidays as $holiday => $details) {
            $holidayDate = (new \DateTime($easter->format('Y-m-d')))->modify("{$details['offset']} days");
            if ($date->format('m-d') === $holidayDate->format('m-d')) {
                return ['type' => $holiday, 'emoji' => $details['emoji']];
            }
        }

        // Saisonale Events mit Emojis
        $seasonalEvents = [
            'spring_equinox' => ['month' => 3, 'start' => 19, 'end' => 21, 'emoji' => '🌱'],
            'summer_solstice' => ['month' => 6, 'start' => 20, 'end' => 22, 'emoji' => '☀️'],
            'autumn_equinox' => ['month' => 9, 'start' => 22, 'end' => 24, 'emoji' => '🍂'],
            'winter_solstice' => ['month' => 12, 'start' => 21, 'end' => 23, 'emoji' => '❄️'],
        ];

        foreach ($seasonalEvents as $event => $details) {
            if ($month === $details['month'] && $day >= $details['start'] && $day <= $details['end']) {
                return ['type' => $event, 'emoji' => $details['emoji']];
            }
        }

        // Prüfungszeiträume mit Emojis
        if (($month === 1 && $day >= 15) || ($month === 2 && $day <= 15)) {
            return ['type' => 'exam_period_winter', 'emoji' => '📚'];
        } elseif (($month === 7 && $day >= 15) || ($month === 8 && $day <= 15)) {
            return ['type' => 'exam_period_summer', 'emoji' => '📝'];
        }

        // Standard-Rückgabe für normale Tage
        return null;
    }

    public function getGreetingContext()
    {
        $user = auth()->user();
        $now = now()->setTimezone('Europe/Berlin');
        $hour = $now->hour;
        
        // Basis-Tageszeit-Gruß mit Emojis
        $timeOfDay = match(true) {
            $hour < 12 => ['greeting' => 'guten Morgen', 'emoji' => '🌅'],
            $hour < 18 => ['greeting' => 'guten Tag', 'emoji' => '☀️'],
            default => ['greeting' => 'guten Abend', 'emoji' => '🌙']
        };

        // Jahreszeit mit Emojis
        $season = match($now->month) {
            12, 1, 2 => ['name' => 'winter', 'emoji' => '❄️'],
            3, 4, 5 => ['name' => 'spring', 'emoji' => '🌸'],
            6, 7, 8 => ['name' => 'summer', 'emoji' => '☀️'],
            9, 10, 11 => ['name' => 'autumn', 'emoji' => '🍁'],
        };

        // Spezielle Tage prüfen
        $specialDay = $this->getSpecialDay($now);
        
        // Letzte Konversation
        $lastConversation = $this->where('user_id', $user->id)
            ->where('tool_identifier', $this->tool_identifier)
            ->where('id', '!=', $this->id)
            ->latest()
            ->first();

        return [
            'username' => $user->name,
            'time_greeting' => $timeOfDay['greeting'],
            'time_emoji' => $timeOfDay['emoji'],
            'season' => $season['name'],
            'season_emoji' => $season['emoji'],
            'special_day' => $specialDay ? $specialDay['type'] : null,
            'special_emoji' => $specialDay ? $specialDay['emoji'] : null,
            'last_conversation' => $lastConversation ? $lastConversation->created_at->diffForHumans() : null
        ];
    }
}
