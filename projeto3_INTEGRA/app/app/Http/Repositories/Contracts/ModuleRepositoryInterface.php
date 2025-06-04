<?php

namespace App\Http\Repositories\Contracts;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ModuleRepositoryInterface
{
    public function findAllOfApplication(int $internalAppId, Request $request): LengthAwarePaginator;
    public function store(int $internalAppId, StoreModuleRequest $request): Module;
    public function findOrFail(int $internalAppId, string $moduleId): Module;
    public function update(int $internalAppId, string $moduleId, UpdateModuleRequest $request): Module;
}