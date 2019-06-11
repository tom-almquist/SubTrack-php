<?php

use Faker\Generator as Faker;

use App\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
