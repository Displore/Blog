<?php

use Faker\Generator as Faker;

$factory->define(Displore\Blog\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->words(5, true),
        'parent' => 0,
    ];
});
