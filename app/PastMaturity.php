<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastMaturity extends Model
{
    protected $fillable = [
        'principal',
        'interest_rate',
        'due_amount',
        'paid_amount',
        'balance',
        'mode_of_payment',
        'last_repayment',
        'late_status',
        'status',

    ];
}
