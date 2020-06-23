<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Categoria;

$factory->define(Categoria::class, function (Faker $faker) {
    $date = now();
    return [
        'nombreCategoria' => $faker->unique()->name,
        'descripcionCategoria' => $faker->words(10),
        'created_at' => $date,
        'updated_at' => $date,
        'deleted_at' => null
    ];
});
