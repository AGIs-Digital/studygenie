<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verifiziere den PayPal Webhook
        if (!$this->verifyWebhookSignature($request)) {
            Log::error('Ungültiger PayPal Webhook-Aufruf');
            return response()->json(['error' => 'Ungültige Signatur'], 400);
        }

        // Debugging für Sandbox
        \Log::channel('daily')->info('PayPal Webhook aufgerufen', [
            'headers' => $request->headers->all(),
            'payload' => $request->all()
        ]);

        $payload = $request->all();
        $eventType = $payload['event_type'];
        
        Log::info('PayPal Webhook empfangen:', ['event_type' => $eventType]);

        switch ($eventType) {
            case 'BILLING.SUBSCRIPTION.CANCELLED':
            case 'BILLING.SUBSCRIPTION.EXPIRED':
            case 'BILLING.SUBSCRIPTION.SUSPENDED':
            case 'BILLING.SUBSCRIPTION.PAYMENT.FAILED':
            case 'BILLING.SUBSCRIPTION.ACTIVATED':
            case 'BILLING.SUBSCRIPTION.UPDATED':
                $this->handleSubscriptionEnd($payload);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    private function handleSubscriptionEnd($payload)
    {
        $subscriptionId = $payload['resource']['id'];
        
        // Finden Sie den Benutzer mit dieser Subscription ID
        $user = User::where('paypal_subscription_id', $subscriptionId)->first();
            
        if ($user) {
            $user->subscription_name = 'Silber';
            $user->paypal_subscription_id = null;
            $user->subscription_status = 'cancelled';
            $user->subscription_end_date = now()->addMonth();
            $user->save();
            
            Log::info('Benutzer-Abonnement auf Silber zurückgesetzt', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }
    }

    private function verifyWebhookSignature($request)
    {
        if (config('services.paypal.mode') !== 'live') {
            return true;
        }

        try {
            $webhookId = config('services.paypal.webhook_id');
            if (!$webhookId) {
                Log::error('PayPal Webhook ID nicht konfiguriert');
                return false;
            }

            $headers = getallheaders();
            
            // PayPal Verifizierungs-Payload
            $verificationData = [
                'auth_algo' => $headers['PAYPAL-AUTH-ALGO'] ?? '',
                'cert_url' => $headers['PAYPAL-CERT-URL'] ?? '',
                'transmission_id' => $headers['PAYPAL-TRANSMISSION-ID'] ?? '',
                'transmission_sig' => $headers['PAYPAL-TRANSMISSION-SIG'] ?? '',
                'transmission_time' => $headers['PAYPAL-TRANSMISSION-TIME'] ?? '',
                'webhook_id' => $webhookId,
                'webhook_event' => $request->all()
            ];

            // PayPal API-Aufruf zur Verifizierung
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://api-m.paypal.com/v1/notifications/verify-webhook-signature',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->getAccessToken(),
                        'Content-Type' => 'application/json'
                    ],
                    'json' => $verificationData
                ]
            );

            $result = json_decode($response->getBody(), true);
            return $result['verification_status'] === 'SUCCESS';

        } catch (\Exception $e) {
            Log::error('PayPal Webhook Signatur Verifikation fehlgeschlagen:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
