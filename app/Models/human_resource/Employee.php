<?php

namespace App\Models\human_resource;

use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\AssignedLocation;
use App\Models\human_resource\EmployeePosition;
use App\Models\human_resource\EmployeeSchedule;
use App\Models\Users\UserAccount;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "hr_employees";
    // app/Models/Employee.php
    protected $guarded = [];

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'id');
    }
    public function employeeSchedule()
    {
        return $this->hasOne(EmployeeSchedule::class, 'employee_id', 'employee_id');
    }

    public function position()
    {
       return $this->belongsTo(EmployeePosition::class, 'employee_position_id', 'row_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id' ,'row_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'row_id');
    }

    public function location()
    {
        return $this->belongsTo(AssignedLocation::class, 'assigned_location', 'id');
    }

}
