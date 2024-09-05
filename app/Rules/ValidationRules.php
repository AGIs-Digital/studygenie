<?php
namespace App\Rules;

use Illuminate\Support\Facades\Validator;

class ValidationRules
{
    public static function validateUserRegistration($data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/', // Mindestens eine Zahl
                'regex:/[A-Z]/', // Mindestens ein Großbuchstabe
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // Mindestens ein Sonderzeichen
            ],
        ]);
    }
    
    public static function validateUserLogin($data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
    
    public static function validatePasswordUpdate($data)
    {
        return Validator::make($data, [
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);
    }
    
    public static function validateArchiveData($data)
    {
        return Validator::make($data, [
            'question' => 'required|string',
            'answer' => 'required|string',
            'tooltype' => 'required|string',
            'type' => 'required|string',
            // Weitere erforderliche Felder...
        ]);
    }
    
    // Weitere Methoden...
}
?>