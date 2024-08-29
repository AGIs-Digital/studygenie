<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [

    ];

    public function boot()
    {
        $this->registerPolicies();

        ResetPasswordNotification::toMailUsing(function ($notifiable, $token) {
            return (new ResetPassword($token))->toMail($notifiable);
        });
    }
}
