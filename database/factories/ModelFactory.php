<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Pwnz22\Taggz\Models\Tag::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->colorName;

    return [
        'name' => $name,
        'slug' => str_slug($name)
    ];
});


$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence
    ];
});


$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'body' => $faker->sentence,
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
