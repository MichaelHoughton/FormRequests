<?php

use Faker\Generator as Faker;

$factory->define(App\Auditor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'company' => $faker->company,
        'phone' => $faker->phoneNumber,
    ];
});
