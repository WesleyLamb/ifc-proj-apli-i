<?php

namespace App\Http\Repositories\Contracts;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ApplicationRepositoryInterface
{
    public function findAll(Request $request): LengthAwarePaginator;
    public function store(StoreApplicationRequest $request): Application;
    public function findOrFail(string $appId): Application;
    public function update(string $appId, UpdateApplicationRequest $request): Application;
    public function delete(string $appId): bool;
}