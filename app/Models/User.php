<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\AvatarUpload;
use Database\Factories\UserFactory;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function PHPUnit\Framework\throwException;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role'
    ];

    const CLIENT = 'client';
    const ADMIN = 'admin';
    const DRIVER = 'driver';
 
    const ALLOWED_ROLES = [
        self::CLIENT,
        self::ADMIN,
        self::DRIVER
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setRoleAttribute($role)
    {
        $role = strtolower(trim($role));
        if(!in_array($role,User::ALLOWED_ROLES)){
            throw new Exception('Invalid role!');
        }
        $this->attributes['role'] = $role;
    }
}
