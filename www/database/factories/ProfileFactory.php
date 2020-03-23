<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'last_name' => 'Yourtube',
        'first_name' => 'Administrateur',
        'dateOfBirth' => $faker->dateTime,
        'avatar' => 'default-user-avatar.png'
    ];
});
