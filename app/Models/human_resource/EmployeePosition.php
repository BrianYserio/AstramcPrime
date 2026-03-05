<?php

namespace App\Models\human_resource;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $guarded = [];
    
    protected $table = "hr_employee_position";

    public function employees()
    {
        return $this->hasMany(Employee::class, 'position');
    }
}
