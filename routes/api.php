<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('tasks', 'Task\TaskController');
Route::resource('test_case', 'TestCase\TestCaseController');
Route::resource('employees', 'Loan\EmployeesController');
Route::resource('loan_request', 'Loan\LoanRequestController');
Route::resource('loan_approved', 'Loan\LoanApprovedController');
Route::resource('payroll', 'Loan\PayrollController');
Route::resource('payroll_generator', 'Loan\PayrollGenerator');
