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
            $table->integer('employee_id');
            $table->float('basic_pay');
            $table->float('sss');
            $table->float('philhealth');
            $table->float('pagibig');
            $table->float('tax');
            $table->float('overtime_hours');
            $table->float('overtime_pay');
            $table->float('absence_late_hours');
            $table->float('absence_late');
            $table->float('incentives');
            $table->float('deductions');
            $table->float('netpay');
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
