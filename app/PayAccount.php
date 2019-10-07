<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayAccount extends Model
{
    protected $fillable = [
        'employee_id',
        'max_amount',
        'balance',
    ];
}
