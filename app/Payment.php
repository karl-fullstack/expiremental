<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'employee_id',
        'loan_id',
        'payment',
        'mode_of_payment',
    ];
}
