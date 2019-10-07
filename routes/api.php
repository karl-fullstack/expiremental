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
Route::resource('pay_account', 'Loan\PayAccountController');