<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccountBranch extends Model
{
    protected $table = 'user_account_branch';

    protected $primaryKey = 'row_id';

    protected $guarded = [];

    protected $casts = [
        'branch' => 'array', // Crucial for multi-select
    ];

    // public function account(): BelongsTo
    // {
    //     return $this->belongsTo(UserAccount::class);
    // }

}
