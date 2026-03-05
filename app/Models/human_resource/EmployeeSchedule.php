<?php

namespace App\Models\human_resource;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $guarded = [];
    
    protected $table = "hr_employee_schedules";

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
