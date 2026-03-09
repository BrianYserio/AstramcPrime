<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccountBranch extends Model
{

    protected $guarded = [];

    protected $table = "user_account_branchs";
    // belongs to one user account
    public function account(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class, 'id', 'id');
    }
}
