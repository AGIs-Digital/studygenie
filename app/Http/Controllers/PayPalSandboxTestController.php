<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalSandboxTestController extends Controller
{
    public function simulateWebhook()
    {
        // Simuliere einen Webhook-Aufruf
        $testPayload = [
            'event_type' => 'BILLING.SUBSCRIPTION.CANCELLED',
            'resource' => [
                'id' => auth()->user()->paypal_subscription_id ?? 'TEST_ID'
            ]
        ];

        Log::info('Simuliere PayPal Webhook', $testPayload);

        $webhookController = new PayPalWebhookController();
        return $webhookController->handleWebhook(new Request($testPayload));
    }
}

