<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePaylipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payslips', function (Blueprint $table) {
            $table->id();
            $table->string('payslip_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('salary_amount', 10, 2);
            $table->string('deduction_amount', 10, 2);
            $table->text('deduction_reason');
            $table->bigInteger('no_of_absents')->default(0);
            $table->bigInteger('no_of_lates')->default(0);
            $table->text('additional_details')->nullable();
            $table->boolean('is_sent')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_paylips');
    }
}
