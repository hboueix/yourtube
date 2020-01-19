<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'administrateur',
        'email' => 'admin@yourtube.fr',
        'email_verified_at' => now(),
        'password' => '$2y$10$vKK1hyK7C6DiQAtkxA4qB.Z8AcC4ANl4jImFIJ8O1iJ1ES/MwtqRW', // motdepasse
        'remember_token' => Str::random(10),
    ];
});
