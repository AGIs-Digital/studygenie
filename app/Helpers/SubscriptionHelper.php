<?php

namespace App\Helpers;

class SubscriptionHelper
{
    public static function hasActiveSubscription($user)
    {
        if (!$user) return false;
        
        // Diamant-User haben immer Zugriff
        if ($user->subscription_name === 'Diamant') return true;
        
        // Gold-User haben Zugriff, solange nicht gekündigt
        if ($user->subscription_name === 'Gold' && $user->subscription_status !== 'cancelled') {
            return true;
        }
        
        return false;
    }
}

