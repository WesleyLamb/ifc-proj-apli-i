<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasUuids;

    public $table = 'licenses';
    public $primaryKey = 'uuid';

    public function establishment()
    {
        return $this->belongsTo(Establishment::class, 'establishment_id', 'id');
    }

    public function applications()
    {
        return $this->hasManyThrough(Application::class, LicenseApplication::class, '1', '2', '3', '4');
    }

    public function applicationModules()
    {
        return $this->belongsToMany(LicenseApplicationModule::class, LicenseApplication::class, 'license_id', 'id', 'id', 'license_application_id');
    }

    public function scopeFromEstablishment(Builder $query, int $internalEstablishmentId)
    {
        return $query->where('establishment_id', $internalEstablishmentId);
    }
}
