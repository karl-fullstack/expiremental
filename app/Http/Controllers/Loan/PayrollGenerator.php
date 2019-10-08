<?php

namespace App\Http\Controllers\Loan;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payroll;

class PayrollGenerator extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = DB::table('employees')
        //     ->join('job_infos', 'job_infos.employee_id', 'employees.id')
        //     ->select('employees.*', 'job_infos.job_title', 'job_infos.salary', 'job_infos.employment_date')
        //     ->get();

        $employees = DB::table('employees')
            ->join('job_infos', 'job_infos.employee_id', 'employees.id')
            ->select('employees.*', 'job_infos.job_title', 'job_infos.salary', 'job_infos.employment_date')
            ->get();

        // $employee_count = $employees->count();

        $absence_late_hours = 3;
        $overtime_hours = 3;
        $tax = 0;
        $incentives = 0;
        $deductions = 0;
        $netpay = 0;
        $cnt = 1;

        foreach($employees as $employee) {
            $payroll = new Payroll;
            $hourly_rate = (($employee->salary)/10)/8;
            $absence_late_deduction = $hourly_rate * $absence_late_hours;
            $overtime_rate = $hourly_rate * $overtime_hours;
            

            $sss = $employee->salary * 0.0363;
            $philhealth = ($employee->salary * 0.0275)/2;
            $pagibig = $employee->salary * 0.02;
            
            $payroll->employee_id = $cnt++;
            $payroll->basic_pay = $employee->salary;
            $payroll->sss = $sss;
            $payroll->philhealth = $philhealth;
            $payroll->pagibig = $pagibig;
            $payroll->tax = $tax;
            $payroll->overtime_hours = $overtime_hours;
            $payroll->overtime_pay = $overtime_rate;
            $payroll->absence_late_hours = $absence_late_hours;
            $payroll->absence_late = $absence_late_deduction;
            $payroll->incentives =  $incentives;
            $payroll->deductions = $deductions;

            $payroll->netpay = ($employee->salary + $incentives + $overtime_rate) - ($sss + $philhealth + $pagibig + $tax + $absence_late_deduction + $deductions) ;

            $payroll->save();

            // return $hourly_rate;
        }
        return $cnt;
        // return $employee_count;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
