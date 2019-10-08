<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobInfo;
use Faker\Generator as Faker;

$autoIncrement1 = autoIncrement1();

$factory->define(JobInfo::class, function (Faker $faker) use ($autoIncrement1)  {
    $autoIncrement1->next();
    return [
        'employee_id' => $autoIncrement1->current(),
        'job_title' => $faker->jobTitle,
        'salary' => $faker->numberBetween($min = 10000, $max = 30000),
        'employment_date' => $faker->date,
    ];
});

function autoIncrement1() {
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}