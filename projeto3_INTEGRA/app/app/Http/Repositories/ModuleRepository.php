<?php

namespace App\Http\Repositories;

use App\Http\DTO\ModuleFilterDTO;
use App\Http\DTO\PaginatorDTO;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;
use App\Models\ModuleScope;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModuleRepository implements ModuleRepositoryInterface
{
    public PaginatorDTO $paginator;
    public ModuleFilterDTO $moduleFilter;

    public function __construct(Request $request)
    {
        $this->paginator = PaginatorDTO::fromRequest($request);
        $this->moduleFilter = ModuleFilterDTO::fromRequest($request);
    }

    public function findAllOfApplication(int $internalAppId, Request $request): LengthAwarePaginator
    {
        return Module::fromApplication($internalAppId)->fromFilters($this->moduleFilter)->paginate($this->paginator->per_page);
    }

    public function store(int $internalAppId, StoreModuleRequest $request): Module
    {
        $module = new Module();

        $module->application_id = $internalAppId;
        $module->name = $request->get('name');
        $module->value = $request->get('value');
        $module->description = $request->get('description');

        $file = Str::random(32).'.png';

        Storage::put($file, base64_decode($request->get('logo')['data']));

        $module->logo_file = $file;
        $module->save();
        $module->refresh();

        foreach ($request->get('scopes') as $value) {
            $scope = new ModuleScope();
            $scope->module_id = $module->id;
            $scope->scope = $value;
            $scope->save();
        }

        return $module->refresh();
    }

    public function findOrFail(int $internalAppId, string $moduleId): Module
    {
        return Module::fromApplication($internalAppId)->where('uuid', $moduleId)->firstOrFail();
    }

    public function update(int $internalAppId, string $moduleId, UpdateModuleRequest $request): Module
    {
        $module = $this->findOrFail($internalAppId, $moduleId);

        $module->name = $request->get('name');
        $module->value = $request->get('value');
        $module->description = $request->get('description');
        if ($request->has('logo.data')) {
            $file = Str::random(32).'.png';

            Storage::put($file, base64_decode($request->get('logo')['data']));

            $module->logo_file = $file;
        }

        $module->save();
        $module->refresh();

        $requestScopes = $request->get('scopes');
        foreach ($module->scopes as $scope)
        {
            if (!in_array($scope->scope, $requestScopes))
            $scope->delete();
        }

        $module->refresh();
        $moduleScopes = $module->scopes->pluck('scope')->toArray();
        foreach ($requestScopes as $value) {
            if (!in_array($value, $moduleScopes)) {
                $scope = new ModuleScope();
                $scope->module_id = $module->id;
                $scope->scope = $value;
                $scope->save();
            }
        }

        return $module->refresh();
    }
}