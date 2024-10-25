<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class SubscriptionController extends Controller
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = Config::get('app.env') === 'production' 
            ? 'https://api-m.paypal.com' 
            : 'https://api-m.sandbox.paypal.com';
    }

    private function getAccessToken()
    {
        try {
            $response = $this->client->post($this->baseUrl . '/v1/oauth2/token', [
                'auth' => [
                    Config::get('services.paypal.client_id'),
                    Config::get('services.paypal.secret')
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            Log::error('PayPal Access Token Error:', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function updateSilberSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $user->subscription_name = 'Silber';
            $user->save();

            return response()->json(['message' => 'Silber status']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update subscription', 'error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        // Logik zur Erstellung eines Abonnements mit PayPal
    }

    public function success()
    {
        return view('subscriptions.success');
    }

    public function cancel()
    {
        return view('subscriptions.cancel');
    }

    public function updateSubscription(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $planName = $request->input('plan_name');
        $subscriptionId = $request->input('subscription_id');

        $user->subscription_name = $planName;
        if ($subscriptionId) {
            $user->paypal_subscription_id = $subscriptionId;
        }
        $user->save();

        return response()->json(['message' => 'Subscription updated successfully']);
    }

    public function cancelSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user || !$user->paypal_subscription_id) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Kein aktives Abo gefunden'
                ], 400);
            }

            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Fehler bei der PayPal-Authentifizierung'
                ], 500);
            }

            // PayPal-Subscription kündigen
            $response = $this->client->post(
                $this->baseUrl . "/v1/billing/subscriptions/{$user->paypal_subscription_id}/cancel",
                [
                    'headers' => [
                        'Authorization' => "Bearer {$accessToken}",
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'reason' => 'Kunde hat Kündigung angefordert'
                    ]
                ]
            );

            if ($response->getStatusCode() === 204) {
                // Subscription in der Datenbank als gekündigt markieren
                $user->subscription_end_date = now()->addMonth(); // Läuft am Ende der Periode aus
                $user->subscription_status = 'cancelled';
                $user->save();

                Log::info('Subscription cancelled', [
                    'user_id' => $user->id,
                    'subscription_id' => $user->paypal_subscription_id
                ]);

                return response()->json([
                    'success' => true, 
                    'message' => 'Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.'
                ]);
            }

            return response()->json([
                'success' => false, 
                'message' => 'Fehler bei der Kündigung bei PayPal'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Subscription Cancellation Error:', [
                'error' => $e->getMessage(),
                'user_id' => $user->id ?? null
            ]);

            return response()->json([
                'success' => false, 
                'message' => 'Fehler bei der Kündigung'
            ], 500);
        }
    }
}
