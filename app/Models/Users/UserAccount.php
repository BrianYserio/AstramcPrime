<?php

namespace App\Models\Users;

use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccountBranch;
use App\Models\Users\UserRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }

    public function userRoles()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(UserAccountBranch::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token = Str::random(60);
        });
    }
}
