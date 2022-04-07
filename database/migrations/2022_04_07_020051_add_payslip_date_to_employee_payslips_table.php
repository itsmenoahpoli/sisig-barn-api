<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayslipDateToEmployeePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_payslips', function (Blueprint $table) {
            $table->date('payslip_for_date')->after('additional_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_payslips', function (Blueprint $table) {
            $table->dropColumn(['payslip_for_date']);
        });
    }
}
