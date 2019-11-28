<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Videos;
use Faker\Generator as Faker;

$factory->define(Videos::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'path' => $faker->text,
        'nbWatch' => $faker->numberBetween($min = 100000, $max = 300000),
        'likes' => $faker->numberBetween($min = 0, $max = 50000),
        'dislikes' => $faker->numberBetween($min = 0, $max = 50000),
        'miniature' => $faker->image('public/storage/images',200,140,null,false),
    ];
});
