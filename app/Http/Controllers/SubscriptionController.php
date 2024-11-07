<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    private $client;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = Config::get('services.paypal.mode') === 'live'
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
        try {
            Log::info('PayPal Subscription Creation', [
                'plan_name' => $request->plan_name,
                'subscription_id' => $request->subscription_id
            ]);
            
            // Ihre bestehende Logik hier
            
        } catch (\Exception $e) {
            Log::error('PayPal Subscription Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ein Fehler ist aufgetreten'
            ], 500);
        }
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
            Log::info('Subscription Update Request:', [
                'plan_name' => $request->input('plan_name'),
                'subscription_id' => $request->input('subscription_id')
            ]);

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Benutzer nicht authentifiziert'
                ], 401);
            }

            $planName = $request->input('plan_name');
            if (!$planName || !in_array($planName, ['Silber', 'Gold', 'Diamant'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ungültiger Plan'
                ], 400);
            }

            DB::beginTransaction();
            try {
                $user->subscription_name = $planName;
                $user->subscription_status = null;
                $user->subscription_end_date = null;
                
                if ($subscriptionId = $request->input('subscription_id')) {
                    $user->paypal_subscription_id = $subscriptionId;
                }
                
                $user->save();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'subscription_name' => $planName,
                    'message' => 'Abonnement erfolgreich aktualisiert',
                    'reload_required' => false
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Fehler bei Abonnement-Aktualisierung:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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
