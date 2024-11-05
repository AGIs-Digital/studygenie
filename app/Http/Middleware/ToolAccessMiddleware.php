<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ToolAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Prüfe Subscription-Status
        if (!$user->subscription_name || $user->subscription_name === 'free') {
            return redirect()->back()->with('error', 'Für dieses Tool benötigen Sie ein aktives Abonnement.');
        }

        return $next($request);
    }
}
