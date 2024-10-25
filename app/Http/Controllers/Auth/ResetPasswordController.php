<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $response = Password::sendResetLink($request->only('email'));

            if ($response == Password::RESET_LINK_SENT) {
                return response()->json(['message' => 'Schau in deine E-Mails, dort findest du den Link zum Passwort-Reset.', 'status' => 'success']);
            } else {
                return response()->json(['message' => 'Fehler beim Senden des Passwort-Reset-Links', 'status' => 'error']);
            }
        } catch (\Exception $e) {
            \Log::error('Fehler beim Senden des Passwort-Reset-Links: ' . $e->getMessage());

            return response()->json(['message' => 'Ein unerwarteter Fehler ist aufgetreten.', 'status' => 'error']);
        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[A-Z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

            $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json(['message' => 'Passwort erfolgreich zurückgesetzt', 'status' => 'success'])
            : response()->json(['message' => 'Fehler beim Zurücksetzen des Passworts', 'status' => 'error']);
    }
}
