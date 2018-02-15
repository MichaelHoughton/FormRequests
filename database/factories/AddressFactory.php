<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'address_1' => $faker->streetAddress,
        'address_2' => $faker->streetAddress,
        'suburb' => $faker->city,
        'post_code' => $faker->postcode,
        'state' => $faker->state,
        'country' => $faker->country,
    ];
});
