<?php

namespace App\Models;

use App\Models\human_resource\Employee;
use App\Models\Users\UserAccount;
use App\Models\Warehouse\UnitManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    protected $guarded = [];

    protected $table = "astra_branches";

    protected $primaryKey = 'row_id';

    public function units(): HasMany
    {
        return $this->hasMany(UnitManagement::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function users()
    {
        return $this->belongsToMany(UserAccount::class, 'user_account_branch',' company_id', 'branch_id' );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::creating(function ($branch) {
            // Get the maximum value of row_id cast to an integer
            $lastId = static::max(DB::raw('CAST(row_id AS UNSIGNED)'));

            // Set the new row_id as the next number in the sequence
            $branch->row_id = (string) ($lastId + 1);
        });
    }
}
