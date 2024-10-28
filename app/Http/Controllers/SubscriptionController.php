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
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Benutzer nicht authentifiziert'], 401);
            }

            $planName = $request->input('plan_name');
            if (!$planName) {
                return response()->json(['message' => 'Plan Name ist erforderlich'], 400);
            }

            if (!in_array($planName, ['Silber', 'Gold', 'Diamant'])) {
                return response()->json(['message' => 'Ungültiger Plan'], 400);
            }

            $subscriptionId = $request->input('subscription_id');
            
            // Zurücksetzen des Kündigungsstatus und Enddatums bei neuem Abo
            $user->subscription_name = $planName;
            $user->subscription_status = null;        // Kündigungsstatus zurücksetzen
            $user->subscription_end_date = null;      // Enddatum zurücksetzen
            
            if ($subscriptionId) {
                $user->paypal_subscription_id = $subscriptionId;
            }
            
            $user->save();

            Log::info('Abonnement aktualisiert und Kündigungsstatus zurückgesetzt', [
                'user_id' => $user->id,
                'new_plan' => $planName,
                'subscription_id' => $subscriptionId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Abonnement erfolgreich aktualisiert'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Fehler bei Abonnement-Aktualisierung:', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ein Fehler ist aufgetreten bei der Aktualisierung des Abonnements'
            ], 500);
        }
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
                Log::error('PayPal Access Token konnte nicht abgerufen werden');
                $this->markSubscriptionAsCancelled($user);
                return response()->json([
                    'success' => true,
                    'message' => 'Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.'
                ]);
            }

            try {
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
                    $this->markSubscriptionAsCancelled($user);
                    return response()->json([
                        'success' => true,
                        'message' => 'Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.'
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('PayPal API Error:', ['error' => $e->getMessage()]);
                $this->markSubscriptionAsCancelled($user);
                return response()->json([
                    'success' => true,
                    'message' => 'Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.'
                ]);
            }

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

    private function markSubscriptionAsCancelled($user)
    {
        $user->subscription_status = 'cancelled';
        $user->subscription_end_date = now()->addMonth();
        $user->save();

        Log::info('Subscription marked as cancelled in database', [
            'user_id' => $user->id,
            'subscription_id' => $user->paypal_subscription_id,
            'end_date' => $user->subscription_end_date->format('Y-m-d H:i:s')
        ]);
    }
}
