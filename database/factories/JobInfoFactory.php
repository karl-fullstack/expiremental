<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobInfo;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(JobInfo::class, function (Faker $faker) use ($autoIncrement)  {
    $autoIncrement->next();
    return [
        'employee_id' => $autoIncrement->current(),
        'job_title' => $faker->jobTitle,
        'salary' => $faker->numberBetween($min = 10000, $max = 30000),
        'employment_date' => $faker->date,
    ];
});

function autoIncrement() {
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}