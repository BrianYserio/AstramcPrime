<?php

namespace App\Models\human_resource;

use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\AssignedLocation;
use App\Models\human_resource\EmployeePosition;
use App\Models\human_resource\EmployeeSchedule;
use App\Models\Users\UserAccount;
use App\Models\Users\UserRole;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "hr_employees";

    protected $keyType = 'string';

    protected $primaryKey = 'row_id';

    protected $guarded = [];

    public function userAccount()
    {                                 //foreign_key_on_users // user_accounts primary key
        return $this->hasOne(UserAccount::class, 'employee_id',  'row_id');
    }
    public function employeeSchedule()
    {                                        //employee foreignkey // schedule primary key
        return $this->hasOne(EmployeeSchedule::class, 'employee_id', 'row_id');
    }

    public function position()
    {                                                   //employee foreignkey // position primary key
       return $this->belongsTo(EmployeePosition::class, 'position_id', 'row_id');
    }

    public function company()
    {                                          //employee foreignkey // company primary key
        return $this->belongsTo(Company::class,'company_id', 'row_id');
    }

    public function branch()
    {                                        //employee foreignkey // branch primary key
        return $this->belongsTo(Branch::class, 'branch_id', 'row_id');
    }

    public function location()
    {                                                 //employee foreignkey // location primary key
        return $this->belongsTo(AssignedLocation::class, 'assigned_location', 'row_id');
    }

    // public function UserRole()
    // {                                                 //employee foreignkey // location primary key
    //     return $this->belongsTo(UserRole::class, 'role_id', 'row_id');
    // }

}
