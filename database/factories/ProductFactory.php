<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->cityPrefix,
        'description' => $faker->text,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
    ];
});
