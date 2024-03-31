<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Http\Controllers\FrontController;

class StartUserSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $userId = $event->user->id;
        $frontController = new FrontController();
        $frontController->startNewSessionWithCustomInstructions($userId);
    }
}
