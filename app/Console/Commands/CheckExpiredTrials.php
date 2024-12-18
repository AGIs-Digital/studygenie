<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CheckExpiredTrials extends Command
{
    protected $signature = 'trials:check';
    protected $description = 'Überprüft und aktualisiert abgelaufene Testzeiträume';

    public function handle()
    {
        $updatedUsers = User::where('expire_date', '<', Carbon::now())
            ->whereNull('subscription_status')
            ->where('subscription_name', 'Diamant')
            ->update([
                'subscription_name' => 'Silber',
                'expire_date' => null
            ]);

        $this->info("{$updatedUsers} abgelaufene Testzeiträume wurden aktualisiert.");
    }
} 