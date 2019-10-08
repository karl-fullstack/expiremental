<?php

namespace App\Http\Controllers\Loan;

use App\LoanRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LoanApproved;
use Illuminate\Support\Facades\DB;

class LoanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('loan_requests')
            ->join('employees', 'loan_requests.employee_id', 'employees.id')
            ->select('loan_requests.*', 'employees.first_name', 'employees.last_name')
            ->get();
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
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LoanRequest $loanRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanRequest $loanRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loan = LoanRequest::where('id', $id)->first();
        
        
        $query = $request->q;


        if($query == 'approve'){
            $loan_check = LoanApproved::where('loan_request_id', $loan->id)->count();

            if($loan_check){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'message' => ['Loan Request Already Approved'],
                ]);
                throw $error;
            }
            else{
                $loan->approval = 'Approved';
                $loan_approve = new LoanApproved;
                $loan_approve->loan_request_id = $loan->id;
                $loan_approve->status = 'Open';
                $loan_approve->save();
            }
            
        }
        else{
            $loan->approval = 'Declined';
        }
        
        
        $loan->save();

        return $loan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanRequest $loanRequest)
    {
        //
    }
}
