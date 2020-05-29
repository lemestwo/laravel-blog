<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title' => $faker->name,
        'summary' => $faker->text(150),
        'content' => $faker->paragraph(10),
        'status' => 1,
        'published_at' => $faker->dateTime,
        'user_id' => User::first()->id
    ];
});
