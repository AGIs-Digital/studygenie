<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        if ($user) {
            $newDateTime = Carbon::create($user->expire_date)->format('m/d/Y H:i:s');
            $date1 = Carbon::createFromFormat('m/d/Y H:i:s', $newDateTime);
            $date2 = Carbon::createFromFormat('m/d/Y H:i:s', Carbon::create(Carbon::now())->format('m/d/Y H:i:s'));

            if ($date1->lte($date2)) {
                $user->updateSubscriptionStatus('silber', null);
            }
        }

        return $next($request);
    }
}
