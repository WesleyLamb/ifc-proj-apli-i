<?php

namespace App\Http\Repositories\Contracts;

use App\Http\Requests\StoreEstablishmentRequest;
use App\Models\Establishment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface EstablishmentRepositoryInterface
{
    public function getAllOfUser(int $internalUserId, Request $request): LengthAwarePaginator;
    public function store(StoreEstablishmentRequest $request): Establishment;
    public function findOrFailOfUser(int $internalUserId, Request $request): Establishment;
}