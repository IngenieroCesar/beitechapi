<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    //Generamos datos de prueba para desarrollo
    return [
        'name' => $faker->cityPrefix,
        'description' => $faker->text,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
    ];
});
