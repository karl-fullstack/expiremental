<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{
    protected $fillable = [
        'project_id',
        'test_case_id',
        'test_case_version',
        'test_case_description',
        'created_by_id',
        'reviewed_by_id',
        'tester_id',
        'qa_tester_log',
        'tested_at',
        'test_case_result',
        'prerequisites',
        'test_data',
        'test_scenario',
        'test_steps',
        'qa_comments',

    ];
}
