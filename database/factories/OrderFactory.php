<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    //Generamos datos de prueba para desarrollo
    return [
        'user_id' => rand(1, 5),
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
    ];
});
