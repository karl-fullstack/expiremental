<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanApproved extends Model
{
    protected $fillable = [
        'loan_request_id',
        'release_date',
        'maturity_date',
        'status',
    ];
}
