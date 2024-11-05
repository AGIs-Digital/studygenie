<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PayPalSandboxTestController extends Controller
{
    public function simulateWebhook()
    {
        $user = auth()->user();
        if (!$user || !$user->paypal_subscription_id) {
            return response()->json(['error' => 'Keine gültige Subscription-ID gefunden'], 400);
        }

        // Simuliere PayPal Webhook Payload
        $testPayload = [
            'event_type' => 'BILLING.SUBSCRIPTION.CANCELLED',
            'resource' => [
                'id' => $user->paypal_subscription_id,
                'status' => 'CANCELLED',
                'status_update_time' => now()->format('Y-m-d\TH:i:s\Z')
            ],
            'summary' => 'Subscription cancelled',
            'create_time' => now()->format('Y-m-d\TH:i:s\Z')
        ];

        Log::info('Simuliere PayPal Webhook', $testPayload);

        // Erstelle Request-Objekt mit Payload
        $request = new Request();
        $request->merge($testPayload);

        // Rufe PayPal Webhook Controller auf
        $webhookController = new PayPalWebhookController();
        return $webhookController->handleWebhook($request);
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

            // Hier kommt die PayPal Webhook-Signaturverifizierung
            $headers = getallheaders();
            $signatureVerification = [
                'auth_algo' => $headers['PAYPAL-AUTH-ALGO'] ?? '',
                'cert_url' => $headers['PAYPAL-CERT-URL'] ?? '',
                'transmission_id' => $headers['PAYPAL-TRANSMISSION-ID'] ?? '',
                'transmission_sig' => $headers['PAYPAL-TRANSMISSION-SIG'] ?? '',
                'transmission_time' => $headers['PAYPAL-TRANSMISSION-TIME'] ?? '',
                'webhook_id' => $webhookId,
                'webhook_event' => $request->all()
            ];

            // Implementieren Sie hier die PayPal Signaturverifizierung
            // Dies erfordert einen API-Aufruf an PayPal's Verify Webhook Signature endpoint
            
            return true; // Temporär für Tests
        } catch (\Exception $e) {
            Log::error('PayPal Webhook Signatur Verifikation fehlgeschlagen:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
