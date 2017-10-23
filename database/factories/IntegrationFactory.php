<?php

use Faker\Generator as Faker;

$factory->define(Displore\Blog\Models\Post::class, function (Faker $faker) {
    return [
        'author_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'category_id' => function() {
            return factory(Displore\Blog\Models\Category::class)->create()->id;
        },
        'title' => $faker->words(5, true),
        'excerpt' => $faker->paragraph,
        'content' => $faker->realText(),
        'type' => 'post',
        'published' => true,
    ];
});