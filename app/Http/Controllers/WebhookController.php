<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verarbeite die Webhook-Benachrichtigung von PayPal
        $event = $request->input('event_type');

        if ($event === 'BILLING.SUBSCRIPTION.RENEWED') {
            $subscriptionId = $request->input('resource.id');
            $user = User::where('paypal_subscription_id', $subscriptionId)->first();

            if ($user) {
                $user->updateSubscriptionStatus($user->subscription_name, Carbon::now()->addMonth());
            }
        } elseif ($event === 'BILLING.SUBSCRIPTION.CANCELLED') {
            $subscriptionId = $request->input('resource.id');
            $user = User::where('paypal_subscription_id', $subscriptionId)->first();

            if ($user) {
                $user->updateSubscriptionStatus('silber', null);
            }
        }

        return response()->json(['status' => 'success']);
    }
}

