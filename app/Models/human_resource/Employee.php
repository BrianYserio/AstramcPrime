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

    protected $keyType = 'string';

    protected $primaryKey = 'employee_id';

    protected $guarded = [];

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class);
    }
    public function employeeSchedule()
    {
        return $this->hasOne(EmployeeSchedule::class, 'id');
    }

    public function position()
    {                                                   //employee foreignkey // position primary key
       return $this->belongsTo(EmployeePosition::class, 'employee_position_row_id', 'row_id');
    }

    public function company()
    {                                          //employee foreignkey // company primary key
        return $this->belongsTo(Company::class,'company_company_id', 'row_id');
    }

    public function branch()
    {                                        //employee foreignkey // branch primary key
        return $this->belongsTo(Branch::class, 'branch_branch_id', 'row_id');
    }

    public function location()
    {                                                 //employee foreignkey // location primary key
        return $this->belongsTo(AssignedLocation::class, 'assigned_location', 'row_id');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $last = self::orderBy('row_id', 'desc')->first();
            $model->row_id = $last ? $last->row_id + 1 : 1;
        });
    }

}
