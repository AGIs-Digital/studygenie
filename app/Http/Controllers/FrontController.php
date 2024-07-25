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
use Illuminate\Support\Facades\Redis;

use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Message;
use App\Models\Conversation;
use App\Custom\Prompt;

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

    // Benutzer erstellen
    public function create(array $data)
    {
        // Erstelle den neuen Benutzer
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tutorial_shown' => false, // Ensure tutorial_shown is set to false for new users
            'expire_date' => null // Set expire_date to null for unlimited duration
        ]);

        // Setze den Subscription-Status basierend auf der Benutzer-ID
        $subscriptionName = $user->id < 100 ? 'diamant' : 'silber';

        // Aktualisiere den Benutzer mit dem Subscription-Status
        $user->subscription_name = $subscriptionName;
        $user->save();

        return $user;
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

    public function changePassword(Request $request)
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
        return $name === 'gold' ? 10 : 20;
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

    /* public function stripePayment(Request $request, $name)
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
    } */

    /*
     * HIER BEGINNEN DIE PROMPTS FÜR DIE TOOLS
     */





    public function GenieCheckprocess(Request $request)
    {
        try {
            $toolIdentifier = 'genie_check';

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
            $message->content = $request->text1;

            # add message to conversation
            $conversation->messages()->save($message);
            $payload = $conversation->createPayload();

            $response = OpenAI::chat()->create($payload);

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray(),
            ]);
        } catch (\Exception $e) {
            throw $e;
            // return $this->handleException($e, "Fehler bei der GenieCheck Anfrage");
        }
    }

    public function JobMatchprocess(Request $request)
    {
        try {
            $toolIdentifier = 'job_match';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            $prompt = $conversation->loadTaskPrompt(['replacements' => [
                'task_strengths' => $request->field1,
                'task_interests' => $request->field2,
                'task_development' => $request->field3,
                'task_environment' => $request->field4,
                'task_control' => $request->field5,
                'task_personality' => $request->field6
            ]]);

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = $prompt;

            # add message to conversation
            $conversation->messages()->save($message);
            $payload = $conversation->createPayload();

            $response = OpenAI::chat()->create($payload);

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray()
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e, "Fehler bei der JobMatch Anfrage");
        }
    }


    public function JobInsiderprocess(Request $request)
    {
        try {
            $toolIdentifier = 'job_insider';

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
            $message->content = $conversation->loadTaskPrompt(['replacements' => ['job_name' => $request->field1]]);

            # add message to conversation
            $conversation->messages()->save($message);
            $payload = $conversation->createPayload();

            $response = OpenAI::chat()->create($payload);

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray()
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler bei der JobMatch Anfrage");
        }
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
