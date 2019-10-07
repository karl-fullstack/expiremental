<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('basic_pay');
            $table->string('sss');
            $table->string('philhealth');
            $table->string('pagibig');
            $table->string('tax');
            $table->string('overtime_hours');
            $table->string('overtime_pay');
            $table->string('absence_late_hours');
            $table->string('absence_late');
            $table->string('incentives');
            $table->string('deductions');
            $table->string('netpay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
