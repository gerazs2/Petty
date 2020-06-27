<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Categoria;

$factory->define(Categoria::class, function (Faker $faker) {
    $date = now();
    return [
        'id' => $faker->unique()->randomNumber(9),
        'nombreCategoria' => substr($faker->unique()->name, 0, 20),
        'descripcionCategoria' => $faker->words(6, true),
        'created_at' => $date,
        'updated_at' => $date,
        'deleted_at' => null
    ];
});
