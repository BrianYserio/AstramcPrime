<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class UserAccountBranch extends Model
{

    protected $guarded = [];

    protected $table = "user_account_branchs";
    // belongs to one user account
    public function account(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'id', 'id');
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
