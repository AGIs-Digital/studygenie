<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        try {
            User::updateOrCreate(
                ['email' => 'admin@studygenie.de'],
                [
                    'name' => 'Admin',
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('admin'),
                    'subscription_name' => 'Diamant',
                    'is_admin' => true,
                ]
            );
        } catch (\Exception $e) {
            \Log::error('Fehler beim Erstellen des Admin-Users: ' . $e->getMessage());
        }
    }
}
