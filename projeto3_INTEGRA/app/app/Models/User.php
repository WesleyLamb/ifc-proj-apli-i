<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /******************************************
    *                                         *
    *               PROPERTIES                *
    *                                         *
    ******************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /******************************************
    *                                         *
    *               ATTRIBUTES                *
    *                                         *
    ******************************************/

    /******************************************
    *                                         *
    *                RELATIONS                *
    *                                         *
    ******************************************/

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    /******************************************
    *                                         *
    *                  SCOPES                 *
    *                                         *
    ******************************************/

    /******************************************
    *                                         *
    *                 METHODS                 *
    *                                         *
    ******************************************/

    public function hasRole(string $role)
    {
        return $this->roles()->firstWhere('role', $role) ? true : false;
    }
}
