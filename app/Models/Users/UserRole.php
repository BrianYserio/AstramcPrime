<?php

namespace App\Models\Users;

use App\Models\Users\UserAccount;
use App\Models\Users\UserPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{

    protected $primaryKey = 'row_id';

    protected $guarded = [];

    protected $table ="user_roles";

    public function accounts(): HasMany
    {
        return $this->hasMany(UserAccount::class, 'role_id', 'row_id');
    }

    // belongs to many permissions (via stored access_id list)
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'role_permissions', 'role_id', 'access_id');
    }
}
