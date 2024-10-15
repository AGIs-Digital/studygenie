<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\SubscriptionService;

class CheckSubscriptionExpiry
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

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

        if ($user) {
            $currentDate = Carbon::now();
            $expireDate = Carbon::create($user->expire_date);

            if ($expireDate->lte($currentDate)) {
                $isRenewed = $this->subscriptionService->renewSubscription($user);

                if (!$isRenewed) {
                    $user->updateSubscriptionStatus('silber', null);
                }
            }
        }

        return $next($request);
    }
}
