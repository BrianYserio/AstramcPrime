<?php

namespace App\Models\Users;

use App\Models\Branch;
use App\Models\Company;
use App\Models\human_resource\Employee;
use App\Models\Users\UserAccountBranch;
use App\Models\Users\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class UserAccount extends Authenticatable
{

    use Notifiable, HasFactory;

    // public $incrementing = false;

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
        return $this->belongsTo(Employee::class, 'employee_id', 'row_id');
    }

    // public function userRoles()
    // {
    //     return $this->belongsToMany(UserRole::class, 'user_id','role_id', 'row_id');
    // }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function branches(): belongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branch_id', 'row_id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    // public function findForPassport($username)
    // {
    //     return $this->where('username', $username)->first();
    // }

    public function userAccountBranch(): hasMany
    {
        return $this->hasMany(UserAccountBranch::class, 'id', 'row_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token = Str::random(60);
        });
    }
}
