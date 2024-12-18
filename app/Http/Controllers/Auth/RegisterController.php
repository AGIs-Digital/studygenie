<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'subscription_name' => 'Silber'
        ]);
    }

    public function postRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[A-Z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
        ]);

        if ($validator->fails()) {
            Log::warning('Failed registration attempt.', ['email' => $request->email]);
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()->all()
            ]);
        }

        $data = $request->all();
        $user = $this->create($data);

        Log::info('User registered successfully.', ['email' => $user->email]);

        $subscriptionUpdated = false;
        $userCount = User::count();

        // 14 Tage Diamant gratis   
        if ($userCount <= 1003) {
            $user->subscription_name = 'Diamant';
            $user->expire_date = Carbon::now()->addDays(14);
            $user->save();
            $subscriptionUpdated = true;
        }

        Auth::login($user);

        return response()->json([
            'status' => true,
            'subscription_updated' => $subscriptionUpdated,
            'redirect' => $request->input('registration_source') === 'plancards' ? route('profile') : route('tools')
        ]);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider): \Illuminate\Http\RedirectResponse
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['message' => 'Fehler bei der Authentifizierung.']);
        }

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
                'subscription_name' => 'Silber',
            ]);
        }

        return $user;
    }
}
