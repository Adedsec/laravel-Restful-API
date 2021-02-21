<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => User::where('email', 'arefmaddah@gmail.com')->first()->id,
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'image' => $faker->imageUrl(),
    ];
});
