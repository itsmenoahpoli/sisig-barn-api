<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee_payslips()
    {
        return $this->hasMany('App\Models\Employees\EmployeePayslip');
    }
}
