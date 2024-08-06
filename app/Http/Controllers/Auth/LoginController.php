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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

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
                'password' => Hash::make(Str::random(16)),
                'tutorial_shown' => 0,
                'subscription_name' => 'silber',
            ]);
        }

        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $userId = Auth::user()->id;
            $frontController = new FrontController();
            $frontController->startNewSessionWithCustomInstructions($userId);

            return redirect('/tools');
        } else {
            return response()->json(['status' => false, 'message' => 'Ungültige Anmeldedaten']);
        }
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()->all()
            ]);
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                "status" => true,
                "redirect_url" => url('/tools')
            ]);
        }

        return response()->json([
            "status" => false,
            "errors" => [
                "Benutzername oder Passwort falsch"
            ]
        ]);
    }
}