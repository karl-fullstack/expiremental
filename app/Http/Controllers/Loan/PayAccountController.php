<?php

namespace App\Http\Controllers\Loan;

use App\PayAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PayAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = DB::table('pay_accounts')
        ->join('employees', 'employees.id', 'pay_accounts.employee_id')
        ->select('pay_accounts.*')
        ->selectRaw("CONCAT(employees.first_name, ' ', employees.last_name) AS full_name")
        ->orderBy('full_name')
        ->get();

        return $accounts;
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
     * @param  \App\PayAccount  $payAccount
     * @return \Illuminate\Http\Response
     */
    public function show(PayAccount $payAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayAccount  $payAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(PayAccount $payAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayAccount  $payAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayAccount $payAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayAccount  $payAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayAccount $payAccount)
    {
        //
    }
}
