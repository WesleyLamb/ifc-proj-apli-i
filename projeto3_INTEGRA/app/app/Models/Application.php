<?php

namespace App\Models;

use App\Http\DTO\ApplicationFilterDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes, HasUuids;
    /******************************************
    *                                         *
    *               PROPERTIES                *
    *                                         *
    ******************************************/

    public $table = 'applications';
    public $primaryKey = 'uuid';

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

    /******************************************
    *                                         *
    *                  SCOPES                 *
    *                                         *
    ******************************************/

    public function scopeFromFilters(Builder $query, ApplicationFilterDTO $dto)
    {
        // TODO: Fazer filtrar por $q
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
