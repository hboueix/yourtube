<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrateur',
            'email' => 'admin@yourtube.fr',
            'email_verified_at' => now(),
            'password' => '$2y$10$vKK1hyK7C6DiQAtkxA4qB.Z8AcC4ANl4jImFIJ8O1iJ1ES/MwtqRW', // motdepasse
            'remember_token' => Str::random(10),
        ])->assignRole('administrateur');
    }
}
