<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\human_resource\Employee;
use App\Models\Warehouse\UnitManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $guarded = [];

    protected $table = "astra_company";

    protected $primaryKey = 'row_id';

    public function units(): HasMany
    {
        return $this->hasMany(UnitManagement::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            // Get the maximum value of row_id cast to an integer
            $lastId = static::max(DB::raw('CAST(row_id AS UNSIGNED)'));

            // Set the new row_id as the next number in the sequence
            $model->row_id = (string) ($lastId + 1);
        });
    }
}
