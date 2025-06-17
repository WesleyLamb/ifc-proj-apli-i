<?php

namespace App\Models;

use App\Http\DTO\EstablishmentFilterDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasUuids;

    public $table = 'establishments';
    public $primaryKey = 'uuid';

    public function users()
    {
        return $this->hasManyThrough(User::class, UserEstablishment::class, 'establishment_id', 'id', 'id', 'user_id');
    }

    public function scopeFromUser(Builder $query, int $internalUserId)
    {
        return $query->whereHas('users', function($q) use ($internalUserId) {
            $q->where('user_id', $internalUserId);
        });
    }

    public function scopeFromFilter(Builder $query, EstablishmentFilterDTO $dto)
    {
        // TODO: Fazer filtrar por $q
        return $query;
    }

    public function getLogoUrl()
    {
        return env('APP_URL').'/storage/'.$this->logo_file;
    }
}
