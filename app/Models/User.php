<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'locale', 'is_active'
    ];

    protected $translatable = ['name'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
}
