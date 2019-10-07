<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PayAccount;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(PayAccount::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'employee_id' => $autoIncrement->current(),
        'max_amount' => 20000,
        'balance' => 20000,
    ];
});

function autoIncrement(){
    for ($i = 0; $i < 1000; $i++){
        yield $i;
    }
}