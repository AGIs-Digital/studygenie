<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import the Hash class
use Illuminate\Support\Str; // Import the Str class

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = $this->findOrCreateUser($socialUser, $provider);
        Auth::login($user, true);

        return redirect('/tools');
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => Hash::make(Str::random(16)), // Generate a random password
                'tutorial_shown' => 0,
                'subscription_name' => 'silber'
            ]);
        }

        return $user;
    }

    public function login(Request $request)
    {
        // Authentifizierungslogik...

        if (Auth::check()) {
            // Benutzer ist eingeloggt
            $userId = Auth::user()->id;
            $frontController = new FrontController();
            $frontController->startNewSessionWithCustomInstructions($userId);
        }

        // Weiterleitung oder Antwort...
    }
}