<?php

use Faker\Generator as Faker;

$factory->define(Displore\Blog\Models\Tag::class, function (Faker $faker) {
    $fake = $faker->word;
    return [
        'name' => $fake,
        'slug' => str_slug($fake),
    ];
});
