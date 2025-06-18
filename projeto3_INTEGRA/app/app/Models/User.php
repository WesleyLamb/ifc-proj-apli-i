<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

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

    public function establishments()
    {
        return $this->hasManyThrough(Establishment::class, UserEstablishment::class, 'user_id', 'id', 'id', 'establishment_id');
    }

    public function userEstablishmentPermission()
    {
        return $this->belongsToMany(UserEstablishmentPermission::class, UserEstablishment::class, 'user_id', 'id', 'id', 'user_establishment_id');
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

    public function canOnEstablishment(string $establishmentId, string $ability)
    {
        $grantedPermissions = [];
        $abilities = explode('.', $ability);
        for ($i = 0; $i < substr_count($ability, '.') + 1; $i++) {
            $grantedPermissions[$i] = null;
            for ($j = 0; $j < $i; $j++) {
                $grantedPermissions[$i] .= $abilities[$j] . '.';
            }
            $grantedPermissions[$i] .= '*';
        }
        $grantedPermissions[] = $ability;
        // dd($ability, substr_count($ability, '.'), explode('.',$ability));
        $establishmentRepository = App::make(EstablishmentRepositoryInterface::class);
        $permission = $this->userEstablishmentPermission()->wherePivot('establishment_id', '=', $establishmentRepository->findOrFailOfUser($this->id, $establishmentId)->id)->whereIn('permission', $grantedPermissions)->first();
        return $permission == true;
    }
}
