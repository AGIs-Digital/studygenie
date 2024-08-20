<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Erstelle den Benutzer
        User::create([
            'name' => 'Admin',
            'email' => 'admin@studygenie.de',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin'),
            'subscription_name' => 'diamant',
            'expire_date' => Carbon::now()->addYear(10),
            'tutorial_shown' => true,
            'is_admin' => true,
        ]);
    }
}
