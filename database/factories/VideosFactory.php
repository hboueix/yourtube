<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Videos;
use Faker\Generator as Faker;

$factory->define(Videos::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'description' => $faker->text,
        'path' => $faker->text,
        'likes' => $faker->randomDigit,
        'dislikes' => $faker->randomNumber,
        'image' => $faker->image('public/storage/images',250,250,null,false)
    ];
});
