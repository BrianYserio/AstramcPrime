<?php

namespace App\Models\human_resource;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $guarded = [];

    protected $table = "hr_employee_schedules";

    protected $primaryKey = 'row_id';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'row_id');
    }
}
