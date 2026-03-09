<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserPermission extends Model
{
    protected $guarded = [];

    protected $table = "user_permission";
    // belongs to many roles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(UserRole::class, 'permissions', 'access_id', 'role_id');
    }
}
