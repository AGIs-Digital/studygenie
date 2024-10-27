<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckSubscriptionExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && 
            $user->subscription_status === 'cancelled' && 
            $user->subscription_end_date && 
            $user->subscription_end_date <= now() &&
            $user->subscription_name !== 'Silber') {
            
            $user->subscription_name = 'Silber';
            $user->subscription_status = null;
            $user->subscription_end_date = null;
            $user->paypal_subscription_id = null;
            $user->save();

            Log::info('Benutzer-Abonnement auf Silber zurückgesetzt (Middleware)', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }

        return $next($request);
    }
}
