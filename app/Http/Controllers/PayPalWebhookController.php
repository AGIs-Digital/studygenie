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
            return true; // Für Testzwecke in Nicht-Produktionsumgebungen
        }
        
        // Implementieren Sie hier die Produktions-Webhook-Signaturverifizierung
        try {
            // PayPal Webhook-Signaturverifizierung
            $headers = $request->headers->all();
            // Implementierung der Signaturprüfung
            return true;
        } catch (\Exception $e) {
            Log::error('PayPal Webhook Signatur Verifikation fehlgeschlagen:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
