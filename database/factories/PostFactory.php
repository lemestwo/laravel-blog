<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title' => $faker->sentence,
        'summary' => $faker->text(150),
        'content' => $faker->paragraph(10),
        'published_at' => $faker->dateTimeThisYear,
        'user_id' => User::all()->random()->id,
    ];
});
