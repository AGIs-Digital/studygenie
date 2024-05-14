<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\User;
use App\Models\Archive;
use App\Models\AIResponse;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Rules\ValidationRules;
use GuzzleHttp\Client as HttpClient;

class FrontController extends Controller
{
    private $endpoint;
    private $username;
    private $httpClient;
    private $openAIKey;
    private $paypalCredentials;

    public function __construct()
    {
        $this->endpoint = config('services.openai.endpoint');
        \Log::info('OpenAI Endpoint aus .env: ' . env('OPENAI_ENDPOINT'));
        \Log::info('OpenAI Endpoint aus config: ' . config('services.openai.endpoint'));
        \Log::info('OpenAI API Key: ' . config('services.openai.key'));

        if (!is_string($this->endpoint) || !preg_match('/^https?:\/\/[\w,.,\/,-]+$/i', $this->endpoint)) {
            throw new \Exception("OpenAI Endpoint ist nicht korrekt konfiguriert.");
        }
        $this->openAIKey = config('services.openai.key');
        $this->paypalCredentials = config('paypal.credentials');
        $this->httpClient = new HttpClient(); // Initialisierung der HttpClient-Instanz
    }

    public function startNewSessionWithCustomInstructions($userId)
    {
        $customInstructions = config('messages.system_prompt');

        # generate a random session id
        $sessionId = bin2hex(random_bytes(16));
        Cache::put("session_user_{$userId}", $sessionId, 3600); // Speichert die Session-ID für 1 Stunde
        return $sessionId;

        // Beispiel-Logik zum Starten einer neuen Session mit OpenAI
        try {
            $response = $this->httpClient->post($this->endpoint . '/sessions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->openAIKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo-1106', // oder ein anderes Modell, je nach Bedarf
                    'custom' => $customInstructions, // Stellen Sie sicher, dass dies das erwartete Format hat
                ],
            ]);

            if ($response->getStatusCode() != 200) {
                \Log::error("Fehlerhafter Statuscode: " . $response->getStatusCode());
                throw new \Exception("Fehler beim Abrufen der Daten. Statuscode: " . $response->getStatusCode());
            }

            $responseData = json_decode($response->getBody()->getContents(), true);
            // Überprüfung, ob 'data' existiert und ob innerhalb von 'data' der Schlüssel 'id' existiert
            if (!isset($responseData['data']) || !isset($responseData['data']['id'])) {
                Log::error("Die Antwort enthält nicht die erwarteten Schlüssel 'data' und 'id'.");
                throw new \Exception("Die Antwort enthält nicht die erwarteten Schlüssel 'data' und 'id'.");
            }
            $sessionId = $responseData['data']['id']; // Zugriff auf die Session-ID

            // Speichern der Session-ID mit einer Zuordnung zum Benutzer
            Cache::put("session_user_{$userId}", $sessionId, 3600); // Speichert die Session-ID für 1 Stunde

            return $sessionId;
        } catch (\Exception $e) {
            \Log::error("Fehler beim Starten einer neuen Session: " . $e->getMessage());
            throw new \Exception("Fehler beim Starten einer neuen Session: " . $e->getMessage() . ". Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.");
        }
    }

    private function getSessionIdForUser($userId)
    {
        return Cache::get("session_user_{$userId}");
    }

    private function saveSessionIdForUser($userId, $sessionId)
    {
        Cache::put("session_user_{$userId}", $sessionId, 3600); // Speichert die Session-ID für 1 Stunde
    }

    public function saveAIResponse($userId, $requestContent, $responseContent, $toolIdentifier)
    {
        $aiResponse = new AIResponse();
        $aiResponse->user_id = $userId;
        $aiResponse->request = $requestContent;
        $aiResponse->response = $responseContent;
        $aiResponse->tool_identifier = $toolIdentifier; // Setzen des Tool-Identifiers
        $aiResponse->save();
    }

    public function sendOpenAIRequest($payload, $userId, $toolIdentifier)
    {
        try {
            Log::info('Memory usage before request: ' . memory_get_usage());
            Log::info('Sending OpenAI request with payload: ', (array)$payload);
            echo '<pre>';
            print_r($payload);
            echo '</pre>';
            return;

            $cacheKey = 'ai_response_' . md5(serialize($payload));
            $response = Cache::remember($cacheKey, 60, function () use ($payload) {
                $httpResponse = $this->httpClient->post($this->endpoint, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->openAIKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $payload,
                ]);

                if ($httpResponse->getStatusCode() >= 400) {
                    Log::error("HTTP-Anfrage fehlgeschlagen mit Statuscode: " . $httpResponse->getStatusCode());
                    throw new \Exception("Fehler bei der Kommunikation mit dem OpenAI-Service. Statuscode: " . $httpResponse->getStatusCode());
                }
                return $httpResponse->getBody()->getContents();
            });

            $response = json_decode($response, true);
            if (is_null($response) || json_last_error() !== JSON_ERROR_NONE) {
                Log::error("Fehler beim Parsen der JSON-Antwort.");
                throw new \Exception("Fehler beim Parsen der JSON-Antwort.");
            }
            if (!isset($response['choices']) || isset($response['error'])) {
                $errorMsg = $response['error']['message'] ?? "Keine 'choices' im Antwortobjekt gefunden.";
                Log::error("OpenAI API Fehler: " . $errorMsg);
                throw new \Exception("OpenAI API Fehler: " . $errorMsg);
            }

            $responseSize = strlen(json_encode($response));
            Log::info("Response size: $responseSize bytes");
            Log::info('Memory usage after request: ' . memory_get_usage());

            $userRequest = collect($payload['messages'])->where('role', 'user')->pluck('content')->last();
            $botResponse = collect($response['choices'])->pluck('message.content')->first();

            $this->saveAIResponse($userId, $userRequest, $botResponse, $toolIdentifier);

            Log::info("Response: " . json_encode($response));
            return $response;
        } catch (\Exception $e) {
            // Hinzufügen von Kontext zur Fehlermeldung für bessere Debugging-Möglichkeiten
            $context = [
                'payload' => $payload,
                'userId' => $userId,
                'toolIdentifier' => $toolIdentifier,
                'exceptionMessage' => $e->getMessage(),
                'exceptionCode' => $e->getCode(),
            ];
            Log::error("Error sending request to OpenAI with context: " . json_encode($context));
            // Umwandlung der Exception in eine benutzerfreundlichere Form
            throw new \Exception("Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.", 0, $e);
        }
    }

    private function getUsername()
    {
        if (is_null($this->username)) {
            $this->username = auth()->user() ? auth()->user()->name : 'Gast';
        }
        return $this->username;
    }

    private function createPayload($newQuestion, $isFirstCommand = true, $firstCommand = null, $toolIdentifier)
    {
        $customInstructions = config('prompts.system_prompt');

        $messages = array_merge($customInstructions, [
            [
                "role" => "user",
                "content" => ! $isFirstCommand ? $firstCommand : "Schüler: " . $newQuestion
            ]
        ]);

        // Die Payload wird direkt zurückgegeben, ohne sie zu einem JSON-String zu konvertieren.
        // Der HTTP-Client kümmert sich intern um die Kodierung.
        return [
            'model' => 'gpt-3.5-turbo-1106',
            'messages' => $messages,
            "temperature" => 0.5,
            "top_p" => 0.5
        ];
    }

    private function formatApiResponse($responseData)
    {
        Log::info("Formatting API response");
        // JSON Parsing und Überprüfung der Datenstruktur
        // Die Zeile zum erneuten Dekodieren von $responseData wurde entfernt, da $responseData bereits als dekodiertes Array übergeben wird.
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Fehler beim Parsen der JSON-Antwort.");
            throw new \Exception("Fehler: Ungültiges JSON-Format.");
        }

        if (!is_array($responseData) || !isset($responseData['choices']) || empty($responseData['choices'])) {
            Log::error("Fehler: Erwartete Datenstruktur 'choices' fehlt oder ist leer.");
            throw new \Exception("Fehler: Erwartete Datenstruktur 'choices' fehlt oder ist leer.");
        }

        $firstChoice = reset($responseData['choices']);
        if (!isset($firstChoice['message']['content'])) {
            Log::error("Fehler: 'message.content' im ersten 'choices'-Element nicht vorhanden.");
            throw new \Exception("Fehler: 'message.content' nicht vorhanden.");
        }

        $data = $firstChoice['message']['content'];

        // Ersetzen von "**text**" durch "<b>text</b>" und von Zeilenumbrüchen durch "<br>"
        $data = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $data);
        $data = str_replace("\n", "<br>", $data);

        return $data;
    }

    // Benutzer erstellen
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthdate' => $data['birthdate'] ?? null,
            'tutorial_shown' => false // Ensure tutorial_shown is set to false for new users
        ]);
    }

    public function postLogin(Request $request)
    {
        // Validierung für das Einloggen
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                "status" => true,
                "redirect" => '/tools'
            ]);
        }

        return response()->json([
            "status" => false,
            "errors" => [
                "Benutzername oder Passwort falsch"
            ]
        ]);
    }

    public function postRegistration(Request $request)
    {
        // Validierung für die Account-Erstellung
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'birthdate' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }

        $user = $this->create($request->all());

        Auth::login($user);

        return response()->json([
            'status' => true,
            'redirect' => '/tools'
        ]);
    }

    public function getArchive()
    {
        $userId = auth()->user()->id;
        $Bildung = Cache::remember("archive_Bildung_{$userId}", 5 * 60, function () use ($userId) {
            return Archive::where('user_id', $userId)->where('type', 'Bildung')->get();
        });

        $Karriere = Cache::remember("archive_Karriere_{$userId}", 5 * 60, function () use ($userId) {
            return Archive::where('user_id', $userId)->where('type', 'Karriere')->get();
        });

        return view('archive', compact('Bildung', 'Karriere'));
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
        return response()->json([
            'status' => '200',
            'message' => 'Nachricht gespeichert'
        ], 200);
    }

    public function updateUserPassword(Request $request)
    {
        $validationResult = $this->validatePasswordUpdate($request);
        if ($validationResult !== true) {
            return redirect()->back()->withErrors($validationResult);
        }

        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Passwort erfolgreich geändert');
    }

    private function validatePasswordUpdate($request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => [
                'required',
                new MatchOldPassword()
            ],
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }

    public function delete()
{
    $user = Auth::user();

    if (is_null($user)) {
        return redirect('/')->withErrors('Kein authentifizierter Benutzer gefunden.');
    }

    DB::beginTransaction(); // Startet eine Datenbanktransaktion

    try {
        Archive::where('user_id', $user->id)->delete();
        AIResponse::where('user_id', $user->id)->delete();
        Cache::forget("session_user_{$user->id}");
        $user->delete();

        DB::commit(); // Bestätigt die Transaktion und speichert die Änderungen

        return redirect('/')->with('success', 'Ihr Account wurde erfolgreich gelöscht.');
    } catch (\Exception $e) {
        DB::rollBack(); // Macht die Transaktion rückgängig, falls ein Fehler auftritt
        return $this->handleException($e, "Fehler beim Löschen des Benutzerkontos");
    }
}

    /*
     * HIER ALLES ZU BEZAHLUNG UND ABO PLÄNEN
     */
    public function paypalindex()
    {
        return view('paypal');
    }

    // Gemeinsame Methode zur Preisfestlegung
    private function determinePrice($name)
    {
        return $name === 'gold' ? 7 : 10;
    }

    public function payment(Request $request, $name)
    {
        if ($name == 'silber') {
            $this->updateSubscriptionStatus($name, null);
            return redirect()->route('profile')->with('success', 'Transaction complete.');
        }

        $price = config("services.paypal.prices.$name", 10); // Standardpreis ist 10
        Session::put('name', $name);
        $response = $this->createPayPalOrder($name, $price);

        return $this->handlePayPalResponse($response);
    }

    private function createPayPalOrder($name, $price)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials($this->paypalCredentials);

        return $provider->createOrder([
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
    }

    private function handlePayPalResponse($response)
    {
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cancel.payment')->with('error', 'Etwas ist schief gelaufen');
        } else {
            return redirect()->route('create.payment')->with('error', $response['message'] ?? 'Etwas ist schief gelaufen');
        }
    }

    // Fehlerbehandlung verbessern
    private function handlePaymentError($message)
    {
        // Detaillierte Fehlerprotokollierung
        Log::error("Zahlungsfehler: " . $message);
        return redirect()->route('profile')->with('error', $message);
    }

    private function updateSubscriptionStatus($name, $expire)
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
        $price = config("services.stripe.prices.$name", 1000); // Standardpreis ist 10 Euro in Cent

        $session = $this->createStripeSession($name, $price);
        return redirect()->away($session->url);
    }

    private function createStripeSession($name, $price)
    {
        return \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'EUR',
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
    }

    public function StripeSuccess(Request $request)
    {
        $value = Session::get('name');
        $currentDate = Carbon::now();
        $next30Days = $currentDate->addDays(30);
        $formattedDate = $next30Days->toDateString();
        $this->updateSubscriptionStatus($value, $formattedDate);
        return redirect()->route('profile')->with('success', 'Transaction complete.');
    }

    public function updatePlaneSec()
    {
        $newDateTime = Carbon::create(auth()->user()->expire_date)->format('m/d/Y H:i:s');
        $date1 = Carbon::createFromFormat('m/d/Y H:i:s', $newDateTime);
        $date2 = Carbon::createFromFormat('m/d/Y H:i:s', Carbon::create(\Carbon\Carbon::now())->format('m/d/Y H:i:s'));
        $result = $date1->gt($date2);
        if (! $result) {
            $this->updateSubscriptionStatus('silber', NULL);
        }
        return true;
    }

    /*
     * HIER BEGINNEN DIE PROMPTS FÜR DIE TOOLS
     */

    public function TextInspirationprocess(Request $request)
    {
        try {
            $newQuestion = $this->TextInspirationQuestion($request);
            $payload = $this->createPayload($newQuestion, true, null, 'TextInspiration');
            $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, 'TextInspiration');

            $formattedData = $this->formatApiResponse($responseData);

            return response()->json([
                "status" => true,
                "data" => $formattedData,
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e, "Fehler bei der TextInspiration Anfrage");
        }
    }

    private function TextInspirationQuestion($request)
    {
        $newQuestion = "Du bist professioneller & kreativer Schriftsteller. Analysiere die folgenden Angaben um mich bei der Texterstellung zu unterstützen: ";

        $fields = [
            'field1' => "Aufgabenart: ",
            'field2' => "Level: ",
            'field3' => "Thema: ",
            'field4' => "Besonderen Anforderungen/Interessen: ",
            'field5' => "Zu erstellender Text: ",
            'field6' => "Bisheriger Text: "
            // Weitere Felder...
        ];

        foreach ($fields as $field => $description) {
            if (!empty($request->$field)) {
                $newQuestion .= $description . $request->$field . " ";
            }
        }

        if (!empty($request->field6)) {
            $newQuestion .= ". Analysiere meinen bisherigen Text und verfasse deine Weiterführung so, dass diese sowohl logisch als auch sprachlich adäquat ist und an meinen bisher verfassten Text nahtlos anknüpft.";
        }

        $newQuestion .= " Verfasse die von mir gewünschte Textpassage und achte dabei auf grammatikalische Korrektheit und Rechtschreibung.";

        return $newQuestion;
    }

    public function TextAnalyseprocess(Request $request)
    {
        $newQuestion = $this->TextAnalyseQuestion($request);
        $payload = $this->createPayload($newQuestion, true, null, 'TextAnalyse');
        $attempt = 0;
        $maxAttempts = 3;
        $responseData = null;
        while ($attempt < $maxAttempts) {
            try {
                $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, 'TextAnalyse');
            } catch (\Exception $e) {
                \Log::error("Fehler bei der TextAnalyse Anfrage: " . $e->getMessage(), ['request' => $request->all()]);
                $attempt++;
                continue;
            }
            if ($responseData !== null && !isset($responseData['error'])) {
                break;
            }
            $attempt++;
        }

        if ($responseData === null || isset($responseData['error'])) {
            $error = $responseData['error'] ?? 'Unbekannter Fehler';
            \Log::error("TextAnalyseprocess Fehler: $error", ['request' => $request->all()]);
            return response()->json([
                "status" => false,
                "error" => "Fehler bei der Anfrage nach $attempt Versuchen: $error",
            ]);
        }

        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData,
        ]);
    }


    private function TextAnalyseQuestion($request)
    {
        $newQuestion = "Analysiere den folgenden Text auf Rechtschreib-, Grammatikfehler und stilistische Aspekte. Korrigiere Rechtschreibfehler und Grammatikfehler nicht direkt im Text, sondern erstelle eine Liste mit den Fehlern und füge dahinter in Klammern die Korrekte Schreibweise an. Vorschläge für Stilverbesserungen sind ebenfalls in der Liste aufzuführen. Argumentiere eventuelle Stilverbesserungen, damit ich die Verbesserungsvorschläge verstehen kann. Ich werde dann entscheiden, ob ich diese Vorschläge übernehmen möchte oder nicht.
        Weise mich auf meine Schwächen und wiederholende Fehler hin.
        Hilf mir mit Merksätzen, Eselsbrücken oder einfache Beispiele diese Fehler künftig zu vermeiden.
        Mein Text: " . $request->field1 . ".";

        return $newQuestion;
    }

    public function GenieCheckprocess(Request $request)
    {
        $newQuestion = $this->GenieCheckQuestion($request);
        $payload = $this->createPayload($newQuestion, true, null, 'GenieCheck');
        $responseData = null; // Initialisierung von responseData mit einem Standardwert

        $error = null;
        try {
            $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, 'GenieCheck');
            // Die Überprüfung von responseData erfolgt direkt nach dem Aufruf der Anfrage
            if ($responseData === null || isset($responseData['error'])) {
                $error = $responseData['error'] ?? 'Unbekannter Fehler';
                \Log::error("GenieCheckprocess Fehler: $error", ['request' => $request->all()]);
            }
        } catch (\Exception $e) {
            $error = "Fehler bei der Anfrage: " . $e->getMessage();
            \Log::error("GenieCheckprocess Fehler: " . $e->getMessage(), ['request' => $request->all()]);
            $responseData = null; // Setzt responseData auf null, um nach einem Fehler die nachfolgende Logik korrekt zu handhaben.
        }
        if ($error !== null) {
            return response()->json([
                "status" => false,
                "error" => $error,
            ]);
        }

        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData,
        ]);
    }

    public function GenieCheckQuestion(Request $request)
    {
        $newQuestion = "Analysiere die eingegebene Nutzerfrage, um das Kernproblem zu identifizieren.
        Gib eine kurze und informative Antwort, die das Wesentliche der Frage abdeckt. Berücksichtige dabei die inhaltliche Ausrichtung der Frage, um festzustellen, welches unserer Tools dem Nutzer zusätzlich von Nutzen sein könnte:
            - Geht es um das Verfassen von Texten, empfiehl das Tool 'TextInspiration' für kreative Schreibhilfen.
            - Geht es um die Verbesserung der Rechtschreibung, der Grammatik oder des Schreibstils, weise auf das Tool 'TextAnalyse' hin.
            - Möchte der Nutzer Wissen generieren und tiefergehende Erklärungen erhalten, ist 'genieTutor' das richtige Tool, um gemeinsam mit StudyGenie interaktiv zu lernen und sich auf Klassenarbeiten & Klausuren vorzubereiten.
            - Bei Fragen zur beruflichen Orientierung oder zum Finden des passenden Berufs, empfiehl 'JobMatch' für einen Interessen- und Fähigkeitstest.
            - Wenn der Nutzer detaillierte Informationen zu spezifischen Berufen sucht, weise auf 'JobInsider' hin.
            - Bei Bedarf an Unterstützung beim Erstellen von Bewerbungsunterlagen, verweise auf 'GenieBewerbung' für maßgeschneiderte Motivationsschreiben und Lebensläufe.
            - Für umfassende Vorbereitung auf Vorstellungsgespräche oder bei Karrierefragen, empfiehl 'KarriereMentor' für interaktive Beratung und Rollenspiele.
        Beachte unbedingt, dass der Hinweis auf das passende Tool subtil ist und natürlich in die Antwort integriert wird.

        Nutzerfrage: " . $request->field1 . ".";
        return $newQuestion;
    }

    public function genieTutor()
    {
        if (auth()->check() && auth()->user()->subscription_name == 'diamant') {
            return view('Bildung.genieTutor');
        }
        return abort(404);
    }

    public function genieTutorFirst()
    {
        $newQuestion = " Du bist mein Tutor. Du hilfst mir beim Lernen und vorbereiten auf Klausuren. Ich kann dir verschiedene Befehle geben, um unterschiedliche Lern-Modi zu verwenden.
        Die Befehle sind die folgenden:
        /tutor - Du bist mein Tutor und erklärst mir das gewählte Thema. Du beantwortest alle meine Nachfragen ausfürlich und gewissenhaft.
        /sokrates - Du antwortest mir immer im sokratischen Stil antwortet. Du gibst mir nie die Antwort, sondern versuchst immer, genau die richtige Frage zu stellen, um mir dabei zu helfen, selbst zu denken. Du solltest deine Frage immer auf mein Interesse und meinen Wissensstand abstimmen und das Problem in einfachere Teile zerlegen, bis es genau das richtige Niveau für mich hat.
        /mc - Du stellst mir Multiple Choice Fragen zum gewählten Thema. Ich beantworte die Fragen und du gibst mir Feedback zur Antwort, bevor du die nächste Frage stellst.
        /test - Du erstellst mir einen Test bestehend aus Multiple Choice Fragen, offenen Fragen und praktischen Fragen. Ziel des Tests ist es, mich optimal auf meine Prüfung vorzubereiten und meinen Lernstand und meine Kenntnisse zu überprüfen. Du fragst mich zu Beginn, wie viele Fragen der Test enthalten soll. Stelle die Fragen nacheinander. Ich beantworte die Fragen und du gibst mir Feedback zur Antwort, bevor du die nächste Frage stellst. Dein Feedback zu meinen Antworten soll dabei sehr kritisch. Bewerte eine Frage nur als richtig, wenn die Antwort von hoher Qualität ist. Am Ende des Testes gibst du mir eine Beurteilung, in welcher du detailliert die Punkte herausstellst, bei denen noch Verbesserungspotenzial besteht.
        /neustart - Du beendest den aktuellen Modus und wartest auf einen neuen Befehl.
        Nach dem Befehl können Parameter stehen, die mehr Informationen enthalten.
        Die Parameter sind: --thema - Das Thema, um das es geht. --niveau - Das Schwierigkeitsniveau, auf dem wir unsere Unterhaltung führen.
        Begrüße mich kurz persönlich und frage mich nur wie du mich unterstützen kannst ohne mir deine Möglichkeiten zu erklären.";
        $toolIdentifier = 'genieTutor'; // Beispiel-Tool-Identifier
        $payload = $this->createPayload($newQuestion, true, null, $toolIdentifier);
        $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, $toolIdentifier);

        // Überprüfung, ob die Antwort null ist oder ein Fehler vorliegt, bevor die Antwort formatiert wird
        if ($responseData === null || (is_array($responseData) && isset($responseData['error']))) {
            $error = is_array($responseData) ? ($responseData['error'] ?? 'Unbekannter Fehler') : 'Unbekannter Fehler';
            return response()->json([
                "status" => false,
                "error" => "Fehler bei der Anfrage: $error",
            ]);
        }

        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData
        ]);
    }

    public function genieTutorUser(Request $request)
    {
        $toolIdentifier = 'genieTutor'; // Beispiel-Tool-Identifier
        $newQuestion = $request->user;
        $isFirstCommand = true; // oder false basierend auf deiner Logik
        $payload = $this->createPayload($newQuestion, $isFirstCommand, null, $toolIdentifier);
        $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, $toolIdentifier);

        // Überprüfung, ob die Antwort null ist oder ein Fehler vorliegt, bevor die Antwort formatiert wird
        if ($responseData === null || (is_array($responseData) && isset($responseData['error']))) {
            $error = is_array($responseData) ? ($responseData['error'] ?? 'Unbekannter Fehler') : 'Unbekannter Fehler';
            return response()->json([
                "status" => false,
                "error" => "Fehler bei der Anfrage: $error",
            ]);
        }

        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData
        ]);
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
        $newQuestion = "Du bist ein interaktiver Karriere-Mentor, der mir hilft, mich auf Klausuren vorzubereiten und mein Verständnis in verschiedenen Themen zu vertiefen. Je nach meinem Bedarf und meiner Anfrage, kannst du in unterschiedlichen Modi agieren:
        /Motivation: Unterstütze mich dabei, meine Ängste vor dem Bewerbungsgespräch zu überwinden, indem du nach konkreten Sorgen fragst und Lösungsansätze aufzeigst.
        /Insides: Versorge mich mit branchenspezifischen Informationen und möglichen Interviewfragen. Auf Nachfrage biete tiefergehende Einblicke zum Unternehmen meiner Bewerbung.
        /Tipps: Teile professionelle Vorbereitungstipps und Strategien für ein erfolgreiches Bewerbungsgespräch. Der Dialog endet, sobald alle meine Fragen geklärt sind.
        /Probe: Führe mit mir ein Rollenspiel als Interviewer. Ich beantworte Fragen und erhalte anschließend dein Feedback mit bis zu drei Ergänzungen, bevor du fortfährst.
        /Neustart: Beende den aktuellen Modus und warte auf den nächsten Befehl mit optionalen Parametern: --beruf und --unternehmen.
        Ich kann jederzeit den Modus wechseln oder spezifische Anweisungen geben, um mein Lernen zu personalisieren. Dein Ziel ist es, mich durch gezielte Fragen, Übungen und Erklärungen zu unterstützen und mein Verständnis zu verbessern.
        Zuletzt haben wir uns mit folgendem auseinandergesetzt:
        [bisherige Zusammenfassung].
        Nun möchte ich, dass du mir bei folgender Frage hilfst: [Userinput]

        Fasse mir zudem unsere bisherige Konversation kurz und prägnant zusammen. Beinhalten soll die Zusammenfassung:
        1. Zuletzt bearbeitetes Thema und Schwierigkeitsniveau: Kurze Erwähnung des zuletzt diskutierten Themas und des Niveaus, um den aktuellen Fokus zu verdeutlichen.
        2. Letzte Interaktionen: Eine Zusammenfassung der letzten Fragen oder Übungen und deiner Antworten oder Lösungen, um den Fortlauf der Konversation zu dokumentieren.
        Schreibe vor die Zusammenfassung immer 'Zusammenfassung: '.";
        $toolIdentifier = 'KarriereMentor'; // Beispiel-Tool-Identifier
        $payload = $this->createPayload($newQuestion, true, null, $toolIdentifier);
        $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, $toolIdentifier);
        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData
        ]);
    }

    public function KarriereMentorUser(Request $request)
    {
        $toolIdentifier = 'KarriereMentor'; // Beispiel-Tool-Identifier
        $newQuestion = $request->user;
        $isFirstCommand = true; // oder false basierend auf deiner Logik
        $payload = $this->createPayload($newQuestion, $isFirstCommand, null, $toolIdentifier);
        $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, $toolIdentifier);
        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData
        ]);
    }


    public function Motivationsschreibenprocess(Request $request)
    {
        $newQuestion = $this->MotivationsschreibenQuestion($request);
        $payload = $this->createPayload($newQuestion, true, null, 'Motivationsschreiben');

        try {
            $response = $this->sendOpenAIRequest($payload, auth()->user()->id, 'Motivationsschreiben');
            $formattedData = $this->formatApiResponse($response);
            return response()->json([
                "status" => true,
                "data" => $formattedData
            ]);
        } catch (\Exception $e) {
            \Log::error("Fehler bei der Motivationsschreiben Anfrage: " . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.']);
        }
    }

    private function MotivationsschreibenQuestion($request)
    {
        $newQuestion = "Du bist langjähriger Bewerbungstrainer und musst mir dabei helfen, ein professionelles und authentisches Motivationsschreiben zu verfassen. ";

        // Hier deine Logik zur Erweiterung des $newQuestion Strings um die Benutzerfelder
        $fields = [
            'field1' => "Berücksichtige bei der Erstellung den von mir angestrebten Studiengang oder Beruf ",
            'field2' => ". Meine persönlichen Stärken sind: ",
            'field3' => ". Berücksichtige meinen akademischen Hintergrund: ",
            'field4' => ". Sowie meine beruflichen Erfahrungen: ",
            'field5' => ". Meine persönliche Motivation für meine Wahl ist: ",
            'field6' => ". Meine persönlicher Bezug zu meiner Wahl: ",
            'field7' => ". Meine persönlichen Erfahrungen und Herausforderungen: "
            // Füge weitere Felder hier hinzu
        ];

        foreach ($fields as $field => $description) {
            if (isset($request->$field)) {
                $newQuestion .= $description . $request->$field;
            }
        }

        $newQuestion .= ". Das Motivationsschreiben soll einen professionellen Eindruck machen, dabei trotzdem einen aufgeschlossenen und motivierten Eindruck meinerseits vermitteln. Verfasse ausschließlich den Text, lasse Formaltäten wie die Anrede am Anfang & und den Gruß am Ende unbedingt weg.";

        return $newQuestion;
    }


    public function JobMatchprocess(Request $request)
    {
            $newQuestion = $this->JobMatchQuestion($request);
            $payload = $this->createPayload($newQuestion, true, null, 'JobMatch');
            $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, 'JobMatch');
            $formattedData = $this->formatApiResponse($responseData);

            return response()->json([
                "status" => true,
                "data" => $formattedData,
            ]);
    }

    private function JobMatchQuestion($request)
    {
        $newQuestion = "Analysiere meine Antworten, um Karrierevorschläge zu erstellen. Berücksichtige: ";

        $fields = [
            'field1' => "1. Persönliche Fähigkeiten & Stärken: ",
            'field2' => "2. Interessen & Leidenschaften: ",
            'field3' => "3. Entwicklungswunsch: ",
            'field4' => "4. Bevorzugte Arbeitsumgebung: ",
            'field5' => "5. Entscheidungsfreiheit & Kontrolle: ",
            'field6' => "6. Persönlichkeitstyp: "
            // Weitere Felder...
        ];

        foreach ($fields as $field => $description) {
            if (! empty($request->$field)) {
                $newQuestion .= $description . $request->$field . " ";
            }
        }
        $newQuestion .= "Ermittle die Top 3 Berufe, die zu meinen Angaben passen. Ziel deiner Vorschläge ist es den Beruf zu finden, der am besten zu mir passt und der persönliches Wachstum ermöglicht und Arbeitszufriedenheit fördert.";

        return $newQuestion;
    }

    public function JobInsiderprocess(Request $request)
    {
            $newQuestion = $this->JobInsiderQuestion($request);
            $payload = $this->createPayload($newQuestion, true, null, 'JobInsider');
            $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, 'JobInsider');
            $formattedData = $this->formatApiResponse($responseData);

            return response()->json([
                "status" => true,
                "data" => $formattedData,
            ]);
    }

    private function JobInsiderQuestion($request)
    {
        $newQuestion = "Erstelle eine Übersicht über den Beruf " . $request->field1 . ". mit folgenden Punkten:
        1. Berufsbeschreibung: Hauptaufgaben und Verantwortlichkeiten in einfacher Sprache.
        2. Qualifikationen und Fähigkeiten: Erforderliche Ausbildungen, Fähigkeiten, Zertifikate und besondere Qualifikationen.
        3. Arbeitsmarkt: Aktuelle Nachfrage, Karrierewege und Entwicklungsmöglichkeiten, inklusive kurz- und langfristiger Aussichten.
        4. Arbeitsumgebung: Typische Umgebung, Arbeitszeiten, physische/psychische Anforderungen.
        5. Gehaltsaussichten: Gehaltsspannen und Einkommensmglichkeiten, inklusive regionaler Unterschiede.
        Herausforderungen und Vorteile: Beiträge zur beruflichen/persönlichen Zufriedenheit, Herausforderungen und Vorteile des Berufs.";
        return $newQuestion;
    }

    public function toolsPage()
    {
        $this->updatePlaneSec();
        return view('Tools');
    }


    private function createConversationContext($userId, $toolIdentifier)
    {
        // Abrufen der letzten 5 Anfragen und Antworten für das spezifische Tool und den Benutzer
        $responses = AIResponse::where('user_id', $userId)
                               ->where('tool_identifier', $toolIdentifier)
                               ->latest()
                               ->take(5)
                               ->get();

        // Erstellen des Kontexts als String
        $context = '';
        foreach ($responses as $response) {
            // Hier können Sie anpassen, wie der Kontext formatiert werden soll
            $context .= "Frage: {$response->request} Antwort: {$response->response} ";
        }
        return $context;
    }

    private function handleException(\Exception $e, $context = 'Allgemeiner Fehler')
    {
        Log::error("$context: " . $e->getMessage());
        return response()->json([
            "status" => false,
            "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
        ]);
    }
}
