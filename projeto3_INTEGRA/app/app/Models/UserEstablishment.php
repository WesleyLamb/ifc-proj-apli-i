<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEstablishment extends Model
{
    public $table = 'users_establishments';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function permission()
    {
        return $this->hasOne(UserEstablishmentPermission::class, 'user_establishment_id', 'id');
    }
}
