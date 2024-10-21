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
                // Toast-Nachricht für den Erfolg
                return response()->json(['status' => 'success', 'redirect' => route('home')]);
                showToast('Schau in deine E-Mails, dort findest du den Link zum Passwort-Reset.', 'success');
            } else {
                return response()->json(['status' => 'error', 'message' => __($response)], 500, ['redirect' => route('home')]);
                showToast('Fehler beim Senden des Passwort-Reset-Links.', 'error');
            }
        } catch (\Exception $e) {
            // Logge den Fehler für weitere Analysen
            \Log::error('Fehler beim Senden des Passwort-Reset-Links: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Ein unerwarteter Fehler ist aufgetreten.'], 500);
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
                'regex:/[0-9]/', // Mindestens eine Zahl
                'regex:/[A-Z]/', // Mindestens ein Großbuchstabe
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // Mindestens ein Sonderzeichen
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

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'errors' => [__($status)]], 500);
    }
}
