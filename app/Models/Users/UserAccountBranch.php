<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccountBranch extends Model
{
    protected $primaryKey = 'row_id';

    protected $guarded = [];

    protected $table = "user_account_branch";
    // belongs to one user account

    public function account(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'row_id');
    }

}
