<?php

namespace App\Http\Repositories\Contracts;

use App\Http\Requests\StoreEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;
use App\Models\Establishment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface EstablishmentRepositoryInterface
{
    public function getAllOfUser(int $internalUserId, Request $request): LengthAwarePaginator;
    public function store(StoreEstablishmentRequest $request): Establishment;
    public function findOrFailOfUser(int $internalUserId, string $establishmentId): Establishment;
    public function update(int $internalUserId, string $establishmentId, UpdateEstablishmentRequest $request): Establishment;
}