<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order_detail;
use Faker\Generator as Faker;

$factory->define(Order_detail::class, function (Faker $faker) {

        return [

            'order_id' => rand(1, 5),
            'description' => $faker->text,
            'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
            'quantity' => rand(1, 5),
        ];
});
