<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'amount',
        'mode_of_transfer',
        'repayment_option',
        'mode_of_payment',
        'reason',
        'approval',
        
    ];
}
