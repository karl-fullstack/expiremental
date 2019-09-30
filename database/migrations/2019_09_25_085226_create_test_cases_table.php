<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('project_id');
            $table->string('test_case_id');
            $table->string('test_case_version');
            $table->text('test_case_description');
            $table->string('created_by_id');
            $table->string('reviewed_by_id');
            $table->string('tester_id');
            $table->text('qa_tester_log');
            $table->date('tested_at');
            $table->string('test_case_result');
            $table->string('prerequisites');
            $table->string('test_data');
            $table->string('test_scenario');
            $table->text('test_steps');
            $table->text('qa_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_cases');
    }
}
