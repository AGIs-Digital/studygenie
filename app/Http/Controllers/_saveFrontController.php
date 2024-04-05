<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\User;
use App\Models\Archive;
use Carbon\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{

    public function GenieCheck(Request $request)
    {
        $type = 'null';
        if ($request->type == 'first') {
            $type = "Prüfe folgenden Text hinsichtlich Fehlern bei Grammatik, Ausdruck, Struktur etc. auf Schulniveau. Korrigiere die Fehlerstellen und markiere FETT was du geändert hast.";
        } else {
            $type = " Korrigiere meine Antwort oder löse die Aufgabe.";
        }
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $firstCommand = 'null';
        $citation = "Korrigiere außerdem nach [citation] - Zitierweise";
        $citation = str_replace("[citation]", $request->citation, $citation);
        $newQuestion = $type . " " . $citation . "Ich erwarte hohe Genauigkeit in der Korrektur. Überprüfe deine Korrektur vor dem Absenden noch einmal gründlich bevor du mir den korrigierten Text ausgibst. Nach der Korrektur erwarte ich ein tabellarisches Feedback mit Anzahl der Fehler für jede übliche Art wie in der Schule (z.B. Rechtschreibung, Grammatik etc.), Summe der gesamten Fehler und die voraussichtliche
        Benotung entsprechend des deutschen Bildungssystems.
        Erkläre mir jeden einzelnen meiner Fehler separat nach Kategorie. Hilf mir mit Merksätze, Eselsbrücken oder einfache Beispiele den Fehler künftig zu vermeiden.
        Im Abschlussfeedback weise auf meine Schwächen und wiederholende Fehler hin.
        Promote deine Premiumfunktion 'Lernen' je nach Schulnote für jede Kategorie.";
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.5
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        return response()->json($responseData);
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        } else {
            if (Auth::attempt($request->only([
                "email",
                "password"
            ]))) {
                return response()->json([
                    "status" => true,
                    "redirect" => url("tools")
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "errors" => [
                        "Invalid credentials"
                    ]
                ]);
            }
        }
    }

    public function postRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }
        $data = $request->all();
        $user = $this->create($data);
        Auth::login($user);
        return response()->json([
            "status" => true,
            "redirect" => url("tools")
        ]);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function GenieTutor()
    {
        if ((auth()->user()->subscription_name == 'diamant')) {
            return view('Bildung.GenieTutor');
        }
        return abort(404);
    }

    public function GenieTutorFirst()
    {
        $username = auth()->user()->name;
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $newQuestion = "Begrüße mich kurz persönlich und frage mich, wie du mich unterstützen kannst. Du bist mein Tutor. Du hilfst mir beim Lernen und vorbereiten auf Klausuren. Ich kann dir verschiedene Befehle geben, um unterschiedliche Lern-Modi zu verwenden.
        Die Befehle sind die folgenden:
        /tutor - Du bist mein Tutor und erklärst mir das gewählte Thema. Du beantwortest alle meine Nachfragen ausführlich und gewissenhaft.
        /sokrates - Du antwortest mir immer im sokratischen Stil antwortet. Du gibst mir nie die Antwort, sondern versuchst immer, genau die richtige Frage zu stellen, um mir dabei zu helfen, selbst zu denken. Du solltest deine Frage immer auf mein Interesse und meinen Wissensstand abstimmen und das Problem in einfachere Teile zerlegen, bis es genau das richtige Niveau für mich hat.
        /mc - Du stellst mir Multiple Choice Fragen zum gewählten Thema. Ich beantworte die Fragen und du gibst mir Feedback zur Antwort, bevor du die nächste Frage stellst.
        /test - Du erstellst mir einen Test bestehend aus Multiple Choice Fragen, offenen Fragen und praktischen Fragen. Ziel des Tests ist es, mich optimal auf meine Prüfung vorzubereiten und meinen Lernstand und meine Kenntnisse zu überprüfen. Du fragst mich zu Beginn, wie viele Fragen der Test enthalten soll. Stelle die Fragen nacheinander. Ich beantworte die Fragen und du gibst mir Feedback zur Antwort, bevor du die nächste Frage stellst. Dein Feedback zu meinen Antworten soll dabei sehr kritisch. Bewerte eine Frage nur als richtig, wenn die Antwort von hoher Qualität ist. Am Ende des Testes gibst du mir eine Beurteilung, in welcher du detailliert die Punkte herausstellst, bei denen noch Verbesserungspotenzial besteht.
        /neustart - Du beendest den aktuellen Modus und wartest auf einen neuen Befehl.
        Nach dem Befehl können Parameter stehen, die mehr Informationen enthalten.
        Die Parameter sind: --thema - Das Thema, um das es geht. --niveau - Das Schwierigkeitsniveau, auf dem wir unsere Unterhaltung führen.";
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                // Hier die Custom Instructions
                [
                    "role" => "system",
                    "content" => "
                    Ich bin StudyGenie, ein persönlicher Assistent mit einem Sinn für Humor und Verhalte mich wie folgt:
                    1. Proaktive Kontexterfassung & Informationsanfrage: Ich stelle zu Beginn jeder Antwort eine spezifische Frage, um den Kontext und Hintergrund der Anfrage besser zu verstehen und fehlende Informationen aktiv zu erfragen.
                    2. Fokussierte & Fehlerfreie Aufgabenausführung: Ich führe Aufgaben direkt und zielgerichtet aus, überprüfe jede Antwort auf Vollständigkeit und Genauigkeit und vermeide unnötige Erklärungen, um Fehler zu minimieren.
                    3. Eigenständiges Denken & Erwartungserfüllung: Ich berücksichtige den Hintergrund der Frage und beziehe relevante Zusammenhänge in die Lösungsfindung ein. Ich stelle eigenständig Fragen um eine vollständige Antwort zu erreichen.
                    4. Strukturierte, Sachliche & Präzise Antworten: Meine Antworten sind logisch aufgebaut, leicht nachvollziehbar, in leichter Sprache verfasst und konzentrieren sich auf sachliche Informationen. Ich beschränke mich nicht selbst in meinen Antworten, sondern strebe an, so präzise und detailliert wie möglich zu antworten.
                    5. Nutzung Aktueller Informationen & Expertenwissen: Ich verwende stets die aktuellsten verfügbaren Informationen und basiere meine Antworten auf Fachkenntnis und Professionalität.
                    6. Markdown-Formatierung: Zur Verbesserung der Lesbarkeit und Strukturierung meiner Antworten nutze ich bevorzugt Aufzählungen statt Fließtext.
                    7. Persönliche & Benutzerfreundliche Ansprache: Ich spreche Dich immer mit Deinem Namen an und interagiere im Stil eines Gesprächs mit einem Freund. Um die Benutzerfreundlichkeit zu maximieren stelle ich nur eine Frage zur Zeit.
                    Buyer Persona: Name: " . $username . ". Alter: 12-18."
                ],
 
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.5
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        $data = $responseData['choices'][0]['message']['content'];
        $data = str_replace("\n", "<br>", $data);
        // Ersetzen von "**text**" durch "<b>text</b>"
        $data = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $data);
        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function GenieTutorUser(Request $request)
    {
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $newQuestion = $request->user;
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.5
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        return response()->json($responseData);
    }

    public function TextInspirationprocess(Request $request)
    {
        $newQuestion = null;
        if (isset($request->field1)) {
            $newQuestion = "Es geht um das Thema " . $request->field1 . ": Gib mir 5 Themenvorschläge zu folgenden Bedingungen:";
            if (isset($request->field2) && isset($request->field3)) {
                $newQuestion = $newQuestion . ' Ich schreibe eine ' . $request->field2 . ' und möchte mein persönliches Interesse an ' . $request->field3 . ' einfließen lassen.';
                if (isset($request->field4)) {
                    $newQuestion = $newQuestion . ' /**Greife bei deiner Antwort meinen Schreibstil aus folgendem Beispieltext auf und verwende diesen: ' . $request->field4 . '
                    Bitte weise mich bei meinem Beispieltext auf häufige Wortwiederholungen sowie wiederholte Satzanfänge hin und biete mir
                    Alternativen an um meinen Stil zu verbessern.';
                }
            }
        } else {
            if (isset($request->field2) && isset($request->field3)) {
                $newQuestion = 'Ich schreibe eine ' . $request->field2 . ' und möchte mein persönliches Interesse an ' . $request->field3 . ' einfließen lassen.';
                if (isset($request->mode)) {
                    $newQuestion = $newQuestion . ' Schreibe mir folgenden Teil: ' . $request->mode;
                }
                if (isset($request->field4)) {
                    $newQuestion = $newQuestion . ' Greife bei deiner Antwort meinen Schreibstil aus folgendem Beispieltext auf und verwende diesen: ' . $request->field4 . '
                    Bitte weise mich bei meinem Beispieltext auf häufige Wortwiederholungen sowie wiederholte Satzanfänge hin und biete mir
                    Alternativen an um meinen Stil zu verbessern.';
                }
            }
        }
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $firstCommand = 'null';
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.7
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        return response()->json($responseData);
    }

    public function genieMotivationprocess(Request $request)
    {
        $newQuestion = "Du bist langjähriger Bewerbungstrainer und musst mir dabei helfen, ein professionelles und authentisches Motivationsschreiben zu verfassen. ";
        if (isset($request->field1)) {
            $newQuestion = $newQuestion . "Berücksichtige bei der Erstellung den von mir angestrebten Studiengang oder Beruf " . $request->field1;
        }
        if (isset($request->field2)) {
            $newQuestion = $newQuestion . "Meine persönliche Motivation für meine Wahl ist " . $request->field2 . " ";
        }
        if (isset($request->field3)) {
            $newQuestion = $newQuestion . "Berücksichtige meine akademischen Hintergründe " . $request->field3 . " ";
        }
        if (isset($request->field4)) {
            $newQuestion = $newQuestion . "Sowie meine beruflichen Erfahrungen " . $request->field4 . " ";
        }
        if (isset($request->field4)) {
            $newQuestion = $newQuestion . "Meine persönlichen Stärken sind " . $request->field5 . " ";
        }
        if (isset($request->field6)) {
            $newQuestion = $newQuestion . "Meine persönlichen Beweggründe für meine Wahl: " . $request->field6 . " ";
        }
        if (isset($request->field7)) {
            $newQuestion = $newQuestion . "Meine persönlichen Erfahrungen und Herausforderungen: " . $request->field7 . " ";
        }
        $newQuestion = $newQuestion . "Das Motivationsschreiben soll einen professionellen Eindruck machen, dabei trotzdem einen aufgeschlossenen und motivierten Eindruck meinerseits vermitteln.";
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $firstCommand = 'null';
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.7
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        return response()->json($responseData);
    }

    public function saveData(Request $request)
    {
        $user_id = auth()->user()->id;
        $data = new Archive();
        $data->user_id = $user_id;
        $data->question = $request->name;
        $data->answer = $request->save_val;
        $data->tooltype = $request->tooltype;
        $data->type = $request->type;
        $data->save();
        // Lösche den Cache für die Archive, damit die neuen Einträge sofort sichtbar sind
        Cache::forget("archive_Bildung_".auth()->user()->id);
        Cache::forget("archive_Karriere_".auth()->user()->id);
        return response()->json([
            'status' => '200',
            'message' => 'Nachricht gespeichert!'
        ], 200);
    }

    public function deleteArchive(Request $request, $id)
    {
        $archive = Archive::find($id);
        if ($archive && $archive->user_id == auth()->user()->id) {
            $archive->delete();
            return response()->json(['status' => 'success', 'message' => 'Antwort erfolgreich gelöscht.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Antwort konnte nicht gefunden werden oder gehört nicht zum Benutzer.'], 404);
        }
    }

    public function KarriereMentor()
    {
        if ((auth()->user()->subscription_name == 'diamant')) {
            return view('Karriere.KarriereMentor');
        }
        return abort(404);
    }

    public function KarriereMentorFirst()
    {
        $username = auth()->user()->name;
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $firstCommand = 'Null';
        $newQuestion = "
        Dein Ziel ist es, meine Ängste und Unsicherheiten zu erkennen und beseitigen und mir praktische Tipps und Vorbereitungsstrategien zu geben.
        Verwende Feedbackschleifen um mein Ziel zu erreichen.
        Begrüße mich zunächst und stelle dich vor. Frage mich anschließend nach und nach im Dialog:
        Wie ich mich im Hinblick auf mein bevorstehendes Bewerbungsgespräch fühle.
        Wofür genau ich mich bewerbe.
        Was meine größten Bedenken und Fragen sind.
        Schlage mir nach eigenem Ermessen im Laufe des Gesprächs vor ein Mock-Interview durchzuführen, bei der du die Rolle des Interviewers einnimmst.
        Ein Mock-Interview muss folgende Fragen stellen: Branchenspezifische, über das Unternehmen, den Beruf und typische Fragen.
        Gebe zu jeder Antwort ein ehrliches und konstuktives Feedback wie die Antwort ankommt und gebe Verbesserungsvorschläge.
        Beende das Gespräch mit einer motivierenden Zusammenfassung erst, wenn wir beide unser Ziel erreich haben und ich keine Fragen mehr habe.
        ";
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                // Hier die Custom Instructions
                [
                    "role" => "system",
                    "content" => "
                    Ich bin StudyGenie, ein persönlicher Assistent mit einem Sinn für Humor und Verhalte mich wie folgt:
                    1. Proaktive Kontexterfassung & Informationsanfrage: Ich stelle zu Beginn jeder Antwort eine spezifische Frage, um den Kontext und Hintergrund der Anfrage besser zu verstehen und fehlende Informationen aktiv zu erfragen.
                    2. Fokussierte & Fehlerfreie Aufgabenausführung: Ich führe Aufgaben direkt und zielgerichtet aus, überprüfe jede Antwort auf Vollständigkeit und Genauigkeit und vermeide unnötige Erklärungen, um Fehler zu minimieren.
                    3. Eigenständiges Denken & Erwartungserfüllung: Ich berücksichtige den Hintergrund der Frage und beziehe relevante Zusammenhänge in die Lösungsfindung ein. Ich stelle eigenständig Fragen um eine vollständige Antwort zu erreichen.
                    4. Strukturierte, Sachliche & Präzise Antworten: Meine Antworten sind logisch aufgebaut, leicht nachvollziehbar, in leichter Sprache verfasst und konzentrieren sich auf sachliche Informationen. Ich beschränke mich nicht selbst in meinen Antworten, sondern strebe an, so präzise und detailliert wie möglich zu antworten.
                    5. Nutzung Aktueller Informationen & Expertenwissen: Ich verwende stets die aktuellsten verfügbaren Informationen und basiere meine Antworten auf Fachkenntnis und Professionalität.
                    6. Markdown-Formatierung: Zur Verbesserung der Lesbarkeit und Strukturierung meiner Antworten nutze ich bevorzugt Aufzählungen statt Fließtext.
                    7. Persönliche & Benutzerfreundliche Ansprache: Ich spreche Dich immer mit Deinem Namen an und interagiere im Stil eines Gesprächs mit einem Freund. Um die Benutzerfreundlichkeit zu maximieren stelle ich nur eine Frage zur Zeit.
                    Buyer Persona: Name: " . $username . ". Alter: 12-18."
                ],
 
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.5
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        $data = $responseData['choices'][0]['message']['content'];
        $data = str_replace("\n", "<br>", $data);
        // Ersetzen von "**text**" durch "<b>text</b>"
        $data = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $data);
        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function JobInsiderprocess(Request $request)
    {
        $username = auth()->user()->name;
        $newQuestion = null;
        $type = 'second';
        if (isset($request->field1)) {
            $newQuestion = "
            Generiere eine umfassende und präzise Übersicht über den folgenden Beruf:" . $request->field1 . ". Die Informationen sollten folgende Aspekte beinhalten, um dem Nutzer eine klare Einschätzung des Berufsfeldes zu ermöglichen:
            1. Berufsbeschreibung: Gib eine Beschreibung des Berufs, inklusive der Hauptaufgaben und Verantwortlichkeiten.
            2. Qualifikationen und Fähigkeiten: Liste die erforderlichen Ausbildungen, Fähigkeiten und Zertifikate auf, die typischerweise für diesen Beruf benötigt werden. Hebe besondere Qualifikationen hervor, die den Beruf besonders attraktiv oder einzigartig machen.
            3. Arbeitsmarkt und Karriereaussichten: Biete Informationen über die aktuelle Nachfrage am deutschen Arbeitsmarkt, Karrierewege und Entwicklungsmöglichkeiten. Betone sowohl kurz- als auch langfristige Perspektiven.
            4. Arbeitsumgebung und -bedingungen: Beschreibe die typische Arbeitsumgebung, Arbeitszeiten und andere relevante Bedingungen. Gehe auch auf häufige physische oder psychische Anforderungen des Berufs ein.
            5. Gehaltsaussichten: Branchenübliche Brutto Gehaltsspanne und Einkommensmöglichkeiten in €. Berücksichtige dabei regionale Unterschiede, falls relevant.
            6. Berufliche Herausforderungen und Vorteile: Erläutere sowohl die Herausforderungen als auch die Vorteile dieses Berufs. Gehe darauf ein, wie dieser Beruf zur beruflichen und persönlichen Zufriedenheit beitragen kann.
            ";
        } else {
            $validator = Validator::make($request->all(), [
                'field2' => 'required',
                'field3' => 'required',
                'field4' => 'required',
                'field5' => 'required',
                'field6' => 'required',
                'field7' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "errors" => $validator->errors(),
                    "message" => "Bitte fülle alle Felder aus"
                ]);
            }
            $type = 'first';
            $newQuestion = "
            Begrüße mich mit meinem Namen. Führe für mich eine persönliche, detaillierte Analyse der Antworten durch, um passende Karrierevorschläge zu generieren. Berücksichtige bei deiner Analyse die folgenden Aspekte:
            1. Persönliche Fähigkeiten & Stärken: " . $request->field2 . "
            2. Interessen & Leidenschaften: " . $request->field3 . "
            3. Wunsch nach Entwicklung/Erlernen neuer Fähigkeiten: " . $request->field4 . "
            4. Bevorzugte Arbeitsumgebung: " . $request->field5 . "
            5. Bedeutung von Entscheidungsfreiheit und Kontrolle: " . $request->field6 . "
            6.Persönlichkeitstyp (Introvertiert/Extrovertiert): " . $request->field7 . "
            Analysiere die Antworten in Bezug auf ihre Übereinstimmungen mit verschiedenen Berufsfeldern und den dort erforderlichen Fähigkeiten, Interessen und Arbeitsumgebungspräferenzen um Berufsvorschläge zu generieren. Beachte dabei auch die Aspekte der persönlichen Entwicklung und der Arbeitszufriedenheit. Identifiziere Berufe, die nicht nur zu den aktuellen Fähigkeiten und Interessen des Nutzers passen, sondern auch Potenzial für persönliches Wachstum bieten, und berücksichtige dabei sowohl die expliziten als auch die impliziten Informationen aus den Antworten.
            Generiere drei Berufsvorschlägen, die auf diesen Analysen basieren, und gib eine kurze Erklärung für jeden Vorschlag, warum dieser Beruf auf Grundlage der gegebenen Antworten als geeignet erachtet wird. Stelle sicher, dass die Vorschläge vielfältig und individuell angepasst sind, um ein breites Spektrum an Möglichkeiten zu reflektieren.
            ";
        }
        $apiKey = env('OPENAI_API_KEY');
        $endpoint = "https://api.openai.com/v1/chat/completions";
        $isFirstCommand = true;
        $firstCommand = 'null';
        $payload = [
            "model" => "gpt-3.5-turbo-1106",
            "messages" => [
                // Hier die Custom Instructions
                [
                    "role" => "system",
                    "content" => "
                    Verhalte dich wie folgt:
                    Sei mein freundlicher, motivierender und bestärkender Assistent mit einem Hauch Humor.
                    Fokussierte & Fehlerfreie Aufgabenausführung: Ich führe Aufgaben direkt und zielgerichtet aus, überprüfe jede Antwort auf Vollständigkeit und Genauigkeit und vermeide unnötige Erklärungen, um Fehler zu minimieren.
                    Strukturierte, Sachliche & Präzise Antworten: Meine Antworten sind logisch aufgebaut, leicht nachvollziehbar, in leichter Sprache verfasst und konzentrieren sich auf sachliche Informationen. Ich beschränke mich nicht selbst in meinen Antworten, sondern strebe an, so präzise und detailliert wie möglich zu antworten.
                    Nutzung Aktueller Informationen & Expertenwissen: Ich verwende stets die aktuellsten verfügbaren Informationen und basiere meine Antworten auf Fachkenntnis und Professionalität.
                    Markdown-Formatierung: Zur Verbesserung der Lesbarkeit und Strukturierung meiner Antworten nutze ich bevorzugt Aufzählungen statt Fließtext.
                    Persönliche & Benutzerfreundliche Ansprache: Ich spreche Dich direkt mit Deinem Namen an und interagiere im  Stil eines Gesprächs mit einem Freund, um die Benutzerfreundlichkeit zu maximieren."
                ],
                // Hier die Buyer Persona
                [
                    "role" => "system",
                    "content" => "Buyer Persona: Name: " . $username . ". Alter: 12-25. Bedürfnisse: Ein freundlicher, bestärkender Assistent der beim Lernen und die Vorbereitung für das Berufsleben unterstützt."
                ],
                [
                    "role" => "user",
                    "content" => ! $isFirstCommand ? $firstCommand : $newQuestion
                ]
            ],
            "temperature" => 0.5
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json'
        ])->post($endpoint, $payload);
        $responseData = $response->json();
        return response()->json([
            "status" => true,
            "data" => $responseData,
            "type" => $type
        ]);
    }

    
     //Alte Archivfunktion ohne Caching
     // public function getArchive()
     // {
     // $Bildung = Archive::where('user_id', auth()->user()->id)->where('type', 'Bildung')->get();
     // $Karriere = Archive::where('user_id', auth()->user()->id)->where('type', 'Karriere')->get();
     // return view('archive', compact('Bildung', 'Karriere'));
     // }
    
    public function getArchive()
    {
        $userId = auth()->user()->id;
        $Bildung = Cache::remember("archive_Bildung_{$userId}", 60 * 60, function () use ($userId) {
            return Archive::where('user_id', $userId)->where('type', 'Bildung')->get();
        });

        $Karriere = Cache::remember("archive_Karriere_{$userId}", 60 * 60, function () use ($userId) {
            return Archive::where('user_id', $userId)->where('type', 'Karriere')->get();
        });

        return view('archive', compact('Bildung', 'Karriere'));
    }

    public function paypalindex()
    {
        return view('paypal');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function payment(Request $request, $name)
    {
        if ($name == 'silber') {
            $this->silberSubscription($name, null);
            return redirect()->route('profile')->with('success', 'Transaction complete.');
        }
        Session::put('name', $name);
        $price = 0;
        if ($name == 'gold') {
            $price = 7;
        } else {
            $price = 10;
        }
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment/cancel')
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $price
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cancel.payment')->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('create.payment')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()->route('profile')->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $value = Session::get('name');
            $currentDate = Carbon::now();
            $next18Days = $currentDate->addDays(30);
            $formattedDate = $next18Days->toDateString();
            $this->silberSubscription($value, $formattedDate);
            return redirect()->route('profile')->with('success', 'Transaction complete.');
        } else {
            return redirect()->route('profile')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    private function silberSubscription($name, $expire)
    {
        $user = User::find(auth()->user()->id);
        $user->subscription_name = $name;
        $user->expire_date = $expire;
        $user->update();
        return true;
    }

    public function stripePayment(Request $request, $name)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        Session::put('name', $name);
        $price = 0;
        $two0 = "00";
        if ($name == 'gold') {
            $price = "7" . $two0;
        } else {
            $price = "10" . $two0;
        }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            "name" => $name
                        ],
                        'unit_amount' => $price
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'success_url' => "http://127.0.0.1:8000/stripe/payment/success",
            "cancel_url" => "http://127.0.0.1:8000/paypal/payment/cancel"
        ]);
        return redirect()->away($session->url);
    }

    public function StripeSuccess(Request $request)
    {
        $value = Session::get('name');
        $currentDate = Carbon::now();
        $next18Days = $currentDate->addDays(30);
        $formattedDate = $next18Days->toDateString();
        $this->silberSubscription($value, $formattedDate);
        return redirect()->route('profile')->with('success', 'Transaction complete.');
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                new MatchOldPassword()
            ],
            'new_password' => [
                'required'
            ],
            'new_confirm_password' => [
                'same:new_password'
            ]
        ]);
        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with('success', 'Password Change Successfully');
    }

    public function updatePlaneSec()
    {
        $newDateTime = Carbon::create(auth()->user()->expire_date)->format('m/d/Y H:i:s');
        $date1 = Carbon::createFromFormat('m/d/Y H:i:s', $newDateTime);
        $date2 = Carbon::createFromFormat('m/d/Y H:i:s', Carbon::create(\Carbon\Carbon::now())->format('m/d/Y H:i:s'));
        $result = $date1->gt($date2);
        if (! $result) {
            $this->silberSubscription('silber', NULL);
        }
        return true;
    }

    public function toolsPage()
    {
        $this->updatePlaneSec();
        return view('Tools');
    }
}
