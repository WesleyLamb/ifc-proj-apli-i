<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\LicenseRepositoryInterface;
use App\Models\License;

class LicenseRepository implements LicenseRepositoryInterface
{
    public function find(int $internalEstablishmentId): License
    {
        return License::fromEstablishment($internalEstablishmentId)->first();
    }
}