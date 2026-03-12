<?php

namespace App\Models\human_resource;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $guarded = [];

    protected $table = "hr_employee_position";

    protected $primaryKey = 'row_id';

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
