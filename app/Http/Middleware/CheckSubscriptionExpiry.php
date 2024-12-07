<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SubscriptionService;

class CheckSubscriptionExpiry
{
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($user = auth()->user()) {
            $this->subscriptionService->checkAndUpdateExpiredSubscription($user);
        }

        return $next($request);
    }
}
