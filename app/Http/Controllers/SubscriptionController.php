<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
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
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $planName = $request->input('plan_name');
        $subscriptionId = $request->input('subscription_id');

        $user->subscription_name = $planName;
        if ($subscriptionId) {
            $user->paypal_subscription_id = $subscriptionId;
        }
        $user->save();

        return response()->json(['message' => 'Subscription updated successfully']);
    }

    public function cancelSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user || !$user->paypal_subscription_id) {
                return response()->json(['success' => false, 'message' => 'Kein aktives Abo gefunden'], 400);
            }

            // PayPal API aufrufen um das Abo zu kündigen
            // TODO: Implementieren Sie hier den PayPal-API-Aufruf zur Kündigung

            return response()->json(['success' => true, 'message' => 'Abo erfolgreich gekündigt']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Fehler bei der Kündigung'], 500);
        }
    }
}
