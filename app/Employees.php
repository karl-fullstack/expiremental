<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name', 
        'birth_date', 
        'email', 
        'phone_number', 
        'landline_number', 
        'address',
        'state',
        'city',
        'region',
        'country'
    ];
}
