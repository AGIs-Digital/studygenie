<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    public function checkAndUpdateExpiredSubscription(User $user): void
    {
        if ($user->subscription_status === 'cancelled' 
            && $user->subscription_end_date 
            && $user->subscription_end_date <= now()
            && $user->subscription_name !== 'Silber') {
            
            $oldSubscription = $user->subscription_name;
            
            $user->subscription_name = 'Silber';
            $user->subscription_status = null;
            $user->subscription_end_date = null;
            $user->paypal_subscription_id = null;
            $user->save();

            Log::info('Benutzer-Abonnement auf Silber zurückgesetzt', [
                'user_id' => $user->id,
                'email' => $user->email,
                'old_subscription' => $oldSubscription
            ]);
        }
    }
}