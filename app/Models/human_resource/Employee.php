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

    public function user()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function schedule()
    {
        return $this->hasOne(EmployeeSchedule::class, 'employee_id');
    }

    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'position');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function location()
    {
        return $this->belongsTo(AssignedLocation::class, 'assigned_location');
    }

}
