<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastMaturitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_maturities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->float('principal');
            $table->float('interest_rate');
            $table->float('due_amount');
            $table->float('paid_amount');
            $table->float('balance');
            $table->string('mode_of_payment');
            $table->string('last_repayment');
            $table->string('late_status');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('past_maturities');
    }
}
