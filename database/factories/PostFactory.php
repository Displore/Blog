<?php

use Faker\Generator as Faker;

$factory->define(Displore\Blog\Models\Post::class, function (Faker $faker) {
    return [
        'author_id' => $faker->randomDigit,
        'category_id' => $faker->randomDigit,
        'title' => $faker->words(5, true),
        'excerpt' => $faker->paragraph,
        'content' => $faker->realText(),
    ];
});