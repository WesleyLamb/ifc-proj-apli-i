<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApplicationRepository;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Repositories\ModuleRepository;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ModuleSummaryResource;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public ApplicationRepository $applicationRepository;
    public ModuleRepository $moduleRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository, ModuleRepositoryInterface $moduleRepository)
    {
        $this->applicationRepository = $applicationRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function index(Request $request)
    {
        return ModuleSummaryResource::collection($this->moduleRepository->findAllOfApplication(
            $this->applicationRepository->findOrFail($request->route('app_id'))->id,
            $request
        ));
    }

    public function store(StoreModuleRequest $request)
    {
        return new ModuleResource($this->moduleRepository->store(
            $this->applicationRepository->findOrFail($request->route('app_id'))->id,
                $request
        ));
    }

    public function show(Request $request)
    {
        return new ModuleResource($this->moduleRepository->findOrFail(
            $this->applicationRepository->findOrFail($request->route('app_id'))->id,
            $request->route('module_id')
        ));
    }

    public function update(UpdateModuleRequest $request)
    {
        return new ModuleResource($this->moduleRepository->update(
            $this->applicationRepository->findOrFail($request->route('app_id'))->id,
            $request->route('module_id'),
            $request
        ));
    }
}
