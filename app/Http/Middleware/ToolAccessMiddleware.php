<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ToolAccessMiddleware
{
    private $toolPermissions = [
        'bildung/tutor' => ['Diamant'],
        'bildung/geniecheck' => ['Silber', 'Gold', 'Diamant'],
        'bildung/textanalyse' => ['Gold', 'Diamant'],
        'bildung/textinspiration' => ['Gold', 'Diamant'],
        'karriere/jobmatch' => ['Silber', 'Gold', 'Diamant'],
        'karriere/jobinsider' => ['Silber', 'Gold', 'Diamant'],
        'karriere/bewerbung' => ['Gold', 'Diamant'],
        'karriere/mentor' => ['Diamant']
    ];

    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        
        // Prüfe ob der Pfad in den geschützten Tools ist
        foreach ($this->toolPermissions as $toolPath => $allowedSubscriptions) {
            if (strpos($path, $toolPath) === 0) {
                $userSubscription = auth()->user()->subscription_name;
                
                if (!in_array($userSubscription, $allowedSubscriptions)) {
                    if ($request->ajax()) {
                        return response()->json([
                            'status' => 'error',
                            'showToolsperre' => true
                        ]);
                    }
                    
                    // Zurück zur vorherigen Seite mit JavaScript
                    return response()->view('components.redirect-with-toolsperre', [], 200);
                }
            }
        }

        return $next($request);
    }
}
