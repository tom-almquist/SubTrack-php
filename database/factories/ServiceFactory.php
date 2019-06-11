<?php

use Faker\Generator as Faker;
use App\Service;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'service_type' => $faker->word,
        'description' => $faker->sentence,
        'cost' => $faker->randomFloat(2, 10, 100),
    ];
});
