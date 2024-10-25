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

        $testPayload = [
            'event_type' => 'BILLING.SUBSCRIPTION.CANCELLED',
            'resource' => [
                'id' => $user->paypal_subscription_id
            ]
        ];

        Log::info('Simuliere PayPal Webhook', $testPayload);

        $webhookController = new PayPalWebhookController();
        return $webhookController->handleWebhook(new Request($testPayload));
    }
}
