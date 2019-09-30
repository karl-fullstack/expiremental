<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employees;
use Faker\Generator as Faker;

$factory->define(Employees::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'middle_name' => null,
        'last_name' => $faker->lastName,
        'birth_date' => $faker->date,
        'email' => $faker->safeEmail,
        'phone_number' => $faker->e164phoneNumber,
        'landline_number' => $faker->tollFreePhoneNumber,
        'address' => $faker->streetAddress,
        'state' => $faker->state,
        'city' => $faker->city,
        'region' => 'Anywhere',
        'country' => $faker->country,
    ];
});
