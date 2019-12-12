<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Videos;
use Faker\Generator as Faker;

$factory->define(Videos::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'path' => $faker->text,
        'nbWatch' => $faker->numberBetween($min = 100000, $max = 300000),
        'likes' => 0,
        'dislikes' => 0,
        'miniature' => $faker->image('public/storage/',200,140,null,false),
    ];
});
