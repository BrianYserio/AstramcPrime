<?php

namespace App\Models\Users;

use App\Models\human_resource\Employee;
use App\Models\Users\UserAccountBranch;
use App\Models\Users\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class UserAccount extends Authenticatable
{

use Notifiable;

    protected $table = 'user_accounts';
    protected $primaryKey = 'row_id'; // Since you used row_id

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
