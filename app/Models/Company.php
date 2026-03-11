<?php

namespace App\Models;

use App\Models\Warehouse\UnitManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $guarded = [];

    protected $table = "astra_company";

    protected $primaryKey = 'row_id';

    public function units(): HasMany
    {
        return $this->hasMany(UnitManagement::class, 'company_id');
    }
}
