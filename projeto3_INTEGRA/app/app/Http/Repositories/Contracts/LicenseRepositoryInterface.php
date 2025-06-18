<?php

namespace App\Http\Repositories\Contracts;

use App\Models\License;

interface LicenseRepositoryInterface
{
    public function find(int $internalEstablishmentId): License;
}