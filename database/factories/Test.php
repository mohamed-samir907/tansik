<?php

use App\Test;

use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        's_number' 	=> $faker->unique()->numberBetween(9001, 10000),
        'name' 		=> $faker->name,
        'address' 	=> $faker->address
    ];
});
