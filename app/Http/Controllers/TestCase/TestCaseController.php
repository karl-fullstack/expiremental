<?php

namespace App\Http\Controllers\TestCase;

use App\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestCaseController extends Controller
{
    /**
     * Display a listing of testcases.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test_case = DB::table('test_cases')
            ->get();

        /*
        *   Task : make the ids available to see the
        */
        // $test_case = DB::table('test_cases')
        //     ->join('users', 'users.id', 'test_cases.created_by_id')
        //     ->select(DB::raw('users'))
        //     ->get();
        


        return $test_case;
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
        $test_case = new TestCase;
        $test_case->project_id = 'New';
        $test_case->test_case_id = $request->test_case_id;
        $test_case->test_case_version = $request->test_case_version;
        $test_case->test_case_description = $request->test_case_description;
        $test_case->created_by_id = $request->created_by_id;
        $test_case->reviewed_by_id = $request->reviewed_by_id;
        $test_case->tester_id = $request->tester_id;
        $test_case->qa_tester_log = $request->qa_tester_log;
        $test_case->tested_at = $request->tested_at;
        $test_case->test_case_result = $request->test_case_result;
        $test_case->prerequisites = json_encode($request->prerequisites);
        $test_case->test_data = json_encode($request->test_data);
        $test_case->test_scenario = $request->test_scenario;
        $test_case->test_steps = json_encode($request->test_steps);
        $test_case->qa_comments = $request->qa_comments;
        $test_case->save();

        return response()->json('Stored');
    }

    /**
     * Display the specified resource.
     *
     * @param [int] $id - ID to be displayed
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test_case = Testcase::find($id);
        json_decode($test_case->prerequisite, true);
        return $test_case;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestCase  $testCase
     * @return \Illuminate\Http\Response
     */
    public function edit(TestCase $testCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestCase  $testCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $test_case = Testcase::find($id);
        $test_case->project_id = $request->project_id;
        $test_case->test_case_id = $request->test_case_id;
        $test_case->test_case_version = $request->test_case_version;
        $test_case->test_case_description = $request->test_case_description;
        $test_case->created_by_id = $request->created_by_id;
        $test_case->reviewed_by_id = $request->reviewed_by_id;
        $test_case->tester_id = $request->tester_id;
        $test_case->qa_tester_log = $request->qa_tester_log;
        $test_case->tested_at = $request->tested_at;
        $test_case->test_case_result = $request->test_case_result;
        $test_case->prerequisites = $request->test_case_id;
        $test_case->test_data = $request->test_data;
        $test_case->test_scenario = $request->test_scenario;
        $test_case->test_steps = $request->test_steps;
        $test_case->qa_comments = $request->qa_comments;
        $test_case->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestCase  $testCase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test_case = Testcase::find($id);
        $test_case->delete();
        return response()->json('Deleted');
    }
}
