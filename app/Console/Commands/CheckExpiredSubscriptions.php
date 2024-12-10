<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\SubscriptionService;

class CheckExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:check-expired';
    protected $description = 'Überprüft und aktualisiert abgelaufene Abonnements';

    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        parent::__construct();
        $this->subscriptionService = $subscriptionService;
    }

    public function handle()
    {
        $expiredUsers = User::where('subscription_status', 'cancelled')
            ->where('subscription_end_date', '<=', now())
            ->where('subscription_name', '!=', 'Silber')
            ->get();

        foreach ($expiredUsers as $user) {
            $this->subscriptionService->checkAndUpdateExpiredSubscription($user);
        }

        $this->info("Abgelaufene Abonnements wurden überprüft und aktualisiert.");
    }
}

