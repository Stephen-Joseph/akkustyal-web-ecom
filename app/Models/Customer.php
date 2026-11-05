<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'email',
        'password_hash',
        'first_name',
        'last_name',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password_hash' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'password_hash';
    }
}