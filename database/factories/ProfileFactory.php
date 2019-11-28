<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'dateOfBirth' => $faker->dateTime,
<<<<<<< HEAD
        'avatar' => $faker->image('public/storage/images',250,250,null,false)
=======
        'image' => $faker->image('public/storage/',250,250,null,false)
>>>>>>> b17d096344ba782f3610aa64dc53d7bf99d499d4
    ];
});
