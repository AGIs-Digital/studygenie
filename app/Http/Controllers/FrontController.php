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

use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Message;
use App\Models\Conversation;

class FrontController extends Controller
{
    private $endpoint;
    private $username;
    private $openAIKey;
    private $paypalCredentials;

    public function __construct()
    {
        $this->paypalCredentials = config('paypal.credentials');
    }

    public function startNewSessionWithCustomInstructions($userId)
    {
        # generate a random session id
        $sessionId = bin2hex(random_bytes(16));
        Cache::put("session_user_{$userId}", $sessionId, 3600); // Speichert die Session-ID für 1 Stunde
        return $sessionId;
    }

    /**
     * Creates the payload for openAi from a conversation
     *
     * @param Conversation $conversation
     * @return array
     */
    private function createPayload($conversation): array
    {
        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get();
        $messages = $messages->map(function ($message) {
            return [
                "role" => $message->role,
                "content" => $message->content
            ];
        });

        # add system prompt as last message
        $messages->push([
            "role" => "system",
            "content" => config('prompts.system_prompt')
        ]);

        $payload = [
            'model' => config('openai.preferred_model'),
            'messages' => $messages
        ];

        return $payload;
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

    public function TextInspirationprocess(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $toolIdentifier = 'textInspiration';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = $this->textInspiration_create_message($request);
            $message->user_id = auth()->user()->id;
            $message->role = 'user';

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der TextInspiration Anfrage");
        }
    }

    /**
     * Creates the prompt for the TextInspiration tool
     */
    private function textInspiration_create_message($request): Message
    {
        $message = new Message();
        $message->content = config('prompts.text_inspiration.base_prompt');
        $message->replacePlaceholder('task_type', $request->field1, "keine Angabe");
        $message->replacePlaceholder('task_level', $request->field2, "keine Angabe");
        $message->replacePlaceholder('task_topic', $request->field3, "keine Angabe");
        $message->replacePlaceholder('task_requirements', $request->field4, "keine Angabe");
        $message->replacePlaceholder('task_text_to_create', $request->field5, "keine Angabe");
        $message->replacePlaceholder('task_previous_text', $request->field6, "keine Angabe");

        # If a previous text is set, add a continuation prompt
        if (!empty($request->field6)) {
            $message->replacePlaceholder('continuation_prompt', config('prompts.text_inspiration.continuation_prompt'), '');
        }

        return $message;
    }

    public function TextAnalyseprocess(Request $request)
    {
        try {
            $toolIdentifier = 'textAnalysis';

            # make sure, $request->text1 is set and not empty
            if (!isset($request->text1) || empty($request->text1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie einen Text ein"
                ]);
            }

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = config('prompts.text_analysis.base_prompt');
            $message->replacePlaceholder('text_to_analyze', $request->text1);

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der TextInspiration Anfrage");
        }
    }

    public function GenieCheckprocess(Request $request)
    {
        try {
            $toolIdentifier = 'genieCheck';

            # make sure, $request->text1 is set and not empty
            if (!isset($request->text1) || empty($request->text1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie eine Frage ein"
                ]);
            }

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = config('prompts.genie_check.base_prompt');
            $message->replacePlaceholder('question', $request->text1);

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der GenieCheck Anfrage");
        }
    }

    public function genieTutor()
    {
        if (auth()->check() && auth()->user()->subscription_name == 'diamant') {
            return view('Bildung.genieTutor');
        }
        return abort(404);
    }

    /**
     * Initiates the Tutor-Conversation with the first message
     */
    public function genieTutorFirst(): \Illuminate\Http\JsonResponse
    {
        $toolIdentifier = 'genieTutor';

        $conversation = new Conversation();
        $conversation->user_id = auth()->user()->id;
        $conversation->tool_identifier = $toolIdentifier;
        $conversation->save();

        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = config('prompts.tutor.first');
        $message->replacePlaceholder('username', auth()->user() ? auth()->user()->name : 'Gast');
        $message->role = 'user';

        $conversation->messages()->save($message);

        $payload = $this->createPayload($conversation);

        $result = OpenAI::chat()->create($payload);

        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $result->choices[0]->message->content;
        $message->role = 'assistant';

        # add message to conversation
        $conversation->messages()->save($message);

        return response()->json([
            "status" => true,
            "data" => $message->content
        ]);
    }

    /**
     * Handles the user input for the Tutor-Conversation
     *
     * @param Request $request
     */
    public function genieTutorUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $toolIdentifier = 'genieTutor';

        # Load conversation to this user and toolIdentifier
        $conversation = Conversation::where('user_id', auth()->user()->id)
            ->where('tool_identifier', $toolIdentifier)
            ->latest()
            ->first();

        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $request->user;
        $message->role = 'user';

        # add message to conversation
        $conversation->messages()->save($message);

        $payload = $this->createPayload($conversation);

        $result = OpenAI::chat()->create($payload);

        # create new message for response
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $result->choices[0]->message->content;
        $message->role = 'assistant';

        # add message to conversation
        $conversation->messages()->save($message);

        return response()->json([
            "status" => true,
            "data" => $message->content
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
        $toolIdentifier = 'karriereMentor';

        # Start a new Conversation
        $conversation = new Conversation();
        $conversation->user_id = auth()->user()->id;
        $conversation->tool_identifier = $toolIdentifier;
        $conversation->save();

        # Add the first message
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = config('prompts.karriere_mentor.first');
        // $message->replacePlaceholder('username', auth()->user() ? auth()->user()->name : 'Gast');
        $message->role = 'user';

        # add the message to the conversation
        $conversation->messages()->save($message);

        # create payload for OpenAI
        $payload = $this->createPayload($conversation);

        # send the request to OpenAI
        $result = OpenAI::chat()->create($payload);

        # create a new message for the response
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $result->choices[0]->message->content;
        $message->role = 'assistant';

        # add message to conversation
        $conversation->messages()->save($message);

        return response()->json([
            "status" => true,
            "data" => $message->content
        ]);
    }

    public function KarriereMentorUser(Request $request)
    {
        $toolIdentifier = 'karriereMentor';

        # Load conversation to this user and toolIdentifier
        $conversation = Conversation::where('user_id', auth()->user()->id)
            ->where('tool_identifier', $toolIdentifier)
            ->latest()
            ->first();

        # Todo: If no conversation is found, redirect to KarriereMentorFirst

        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $request->user;
        $message->role = 'user';

        # add message to conversation
        $conversation->messages()->save($message);

        $payload = $this->createPayload($conversation);

        $result = OpenAI::chat()->create($payload);

        # create new message for response
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $result->choices[0]->message->content;
        $message->role = 'assistant';

        # add message to conversation
        $conversation->messages()->save($message);

        return response()->json([
            "status" => true,
            "data" => $message->content
        ]);
    }


    public function Motivationsschreibenprocess(Request $request)
    {
        try {
            $toolIdentifier = 'motivationalLetter';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = config('prompts.motivational_letter.base_prompt');
            $message->replacePlaceholder('task_job', $request->field1, "keine Angabe");
            $message->replacePlaceholder('task_strengths', $request->field2, "keine Angabe");
            $message->replacePlaceholder('task_academic', $request->field3, "keine Angabe");
            $message->replacePlaceholder('task_experience', $request->field4, "keine Angabe");
            $message->replacePlaceholder('task_motivation', $request->field5, "keine Angabe");
            $message->replacePlaceholder('task_personal', $request->field6, "keine Angabe");
            $message->replacePlaceholder('task_challenges', $request->field7, "keine Angabe");

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der GenieCheck Anfrage");
        }
    }

    public function JobMatchprocess(Request $request)
    {
        try {
            $toolIdentifier = 'jobMatch';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = config('prompts.job_match.base_prompt');
            $message->replacePlaceholder('task_strengths', $request->field1, "keine Angabe");
            $message->replacePlaceholder('task_interests', $request->field2, "keine Angabe");
            $message->replacePlaceholder('task_development', $request->field3, "keine Angabe");
            $message->replacePlaceholder('task_environment', $request->field4, "keine Angabe");
            $message->replacePlaceholder('task_control', $request->field5, "keine Angabe");
            $message->replacePlaceholder('task_personality', $request->field6, "keine Angabe");

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e, "Fehler bei der JobMatch Anfrage");
        }
    }


    public function JobInsiderprocess(Request $request)
    {
        try {
            $toolIdentifier = 'jobInsider';

            # make sure $request->field1 is set and not empty
            if (!isset($request->field1) || empty($request->field1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie einen Jobnamen ein"
                ]);
            }

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = config('prompts.job_insider.base_prompt');
            $message->replacePlaceholder('job_name', $request->field1);

            # add message to conversation
            $conversation->messages()->save($message);

            $response = OpenAI::chat()->create($this->createPayload($conversation));

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der JobMatch Anfrage");
        }
    }


    public function toolsPage()
    {
        $this->updatePlaneSec();
        return view('Tools');
    }

    private function handleException(\Exception $e, $context = 'Allgemeiner Fehler')
    {
        Log::error("$context: " . $e->getMessage());
        print($e->getMessage());
        return response()->json([
            "status" => false,
            "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
        ]);
    }
}
