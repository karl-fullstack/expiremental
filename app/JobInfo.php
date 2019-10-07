<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    protected $fillable = [
        'job_title',
        'salary',
        'employment_date',
    ];
}
