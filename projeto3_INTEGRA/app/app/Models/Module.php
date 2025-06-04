<?php

namespace App\Models;

use App\Http\DTO\ModuleFilterDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasUuids, SoftDeletes;

    /******************************************
    *                                         *
    *               PROPERTIES                *
    *                                         *
    ******************************************/

    public $table = 'modules';
    public $primaryKey = 'uuid';

    /******************************************
    *                                         *
    *               ATTRIBUTES                *
    *                                         *
    ******************************************/

    public function scopes()
    {
        return $this->hasMany(ModuleScope::class, 'module_id', 'id');
    }

    /******************************************
    *                                         *
    *                RELATIONS                *
    *                                         *
    ******************************************/

    /******************************************
    *                                         *
    *                  SCOPES                 *
    *                                         *
    ******************************************/

    public function scopeFromApplication(Builder $query, int $internalAppId)
    {
        return $query = $query->where('application_id', $internalAppId);
    }

    public function scopeFromFilters(Builder $query, ModuleFilterDTO $dto)
    {
        // TODO: Fazer filtros $q
        return $query;
    }

    /******************************************
    *                                         *
    *                 METHODS                 *
    *                                         *
    ******************************************/

    public function getLogoUrl()
    {
        return env('APP_URL').'/storage/'.$this->logo_file;
    }
}
