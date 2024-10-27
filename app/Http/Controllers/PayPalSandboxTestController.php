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
}
