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
            'expire_date' => null, // Set expire_date to null for unlimited duration
            'subscription_name' => 'silber'
        ]);

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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/', // Mindestens eine Zahl
                'regex:/[A-Z]/', // Mindestens ein Großbuchstabe
                'regex:/[@$!%*?&#]/' // Mindestens ein Sonderzeichen
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }

        // Korrigiere den Passwort-Parameter
        $data = $request->all();

        $user = $this->create($data);

        // Überprüfe die ID des Benutzers und aktualisiere den subscription_name
        if ($user->id <= 100) {
            $user->subscription_name = 'diamant';
            $user->save();
            Auth::login($user);
            return response()->json([
                'status' => true,
                'redirect' => '/tools',
                'subscription_updated' => true
            ]);
        }

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
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/', // Mindestens eine Zahl
                'regex:/[A-Z]/', // Mindestens ein Großbuchstabe
                'regex:/[@$!%*?&#]/' // Mindestens ein Sonderzeichen
            ],
            'new_confirm_password' => 'same:new_password'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}