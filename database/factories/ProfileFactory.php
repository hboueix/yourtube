<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Profile::class, function (Faker $faker) {
    $image = $faker->image();
    $imageFile = new File($image);
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'dateOfBirth' => $faker->dateTime,
        'image' => $faker->image('public/storage/',250,250,null,false)
    ];
});
