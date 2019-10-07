<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'basic_pay',
        'sss',
        'philhealth',
        'pagibig',
        'tax',
        'overtime_hours',
        'overtime_pay',
        'absence_late_hours',
        'absence_late',
        'incentives',
        'deductions',
        'netpay',
    ];
}
