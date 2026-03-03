<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class UserAccount extends Authenticatable
{
    protected $table = 'user_accounts';

    protected $fillable = [
        'user_id',
        'username',
        'password',
        'api_token',
        'role',
        'prepared_by',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token = Str::random(60);
        });
    }
}
