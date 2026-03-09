<?php

namespace App\Models\Users;

use App\Models\human_resource\Employee;
use App\Models\Users\UserAccountBranch;
use App\Models\Users\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class UserAccount extends Authenticatable
{
    use HasRoles;
    
    protected $table = 'user_accounts';

    protected $guarded= [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function userRoles()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'role', 'role_id');
    }

    public function branches(): HasMany
    {
        return $this->hasMany(UserAccountBranch::class, 'id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token = Str::random(60);
        });
    }
}
