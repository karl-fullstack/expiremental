<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LoanRequest;
use Faker\Generator as Faker;

$autoIncrement2 = autoIncrement2();

$factory->define(LoanRequest::class, function (Faker $faker) use ($autoIncrement2) {
    $autoIncrement2->next();
    return [
        'employee_id' => $autoIncrement2->current(),
        'amount' => $faker->numberBetween($min = 1000, $max = 10000),
        'mode_of_transfer' => 'Cash',
        'repayment_option' => 'Monthly',
        'mode_of_payment' => 'Deduction',
        'reason' => 'Nothing',
        'approval'=> 'Pending',
    ];
});

function autoIncrement2()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}