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
            $user->save();
            
            Log::info('Benutzer-Abonnement auf Silber zurückgesetzt', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }
    }

    private function verifyWebhookSignature($request)
    {
        // Implementierung der PayPal Webhook-Signatur-Verifizierung
        // https://developer.paypal.com/api/rest/webhooks/
        return true; // Temporär für Tests
    }
}
