<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body'  => $faker->text,
        'created_at' => now(),
    ];
});

