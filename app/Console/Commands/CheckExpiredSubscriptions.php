<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:check-expired';
    protected $description = 'Überprüft und aktualisiert abgelaufene Abonnements';

    public function handle()
    {
        $expiredUsers = User::where('subscription_status', 'cancelled')
            ->where('subscription_end_date', '<=', now())
            ->where('subscription_name', '!=', 'Silber')
            ->get();

        foreach ($expiredUsers as $user) {
            $user->subscription_name = 'Silber';
            $user->subscription_status = null;
            $user->subscription_end_date = null;
            $user->paypal_subscription_id = null;
            $user->save();

            Log::info('Benutzer-Abonnement auf Silber zurückgesetzt', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }

        $this->info("Abgelaufene Abonnements wurden überprüft und aktualisiert.");
    }
}

