<?php

namespace App\Http\Repositories\Contracts;

use App\Http\Requests\StoreLicenseApplicationRequest;
use App\Models\License;
use Illuminate\Pagination\LengthAwarePaginator;

interface LicenseRepositoryInterface
{
    public function getAll(int $internalEstablishmentId): LengthAwarePaginator;
    public function findOrFailOfEstablishment(int $internalEstablishmentId, string $licenseId): License;
    public function addApplication(int $internalLicenseId, StoreLicenseApplicationRequest $request): License;
}