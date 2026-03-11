<?php

namespace App\Models;

use App\Models\Warehouse\UnitManagement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $guarded = [];

    protected $table = "astra_branches";

    protected $primaryKey = 'row_id';

    public function units(): HasMany
    {
        return $this->hasMany(UnitManagement::class, 'branch_id');
    }
}
