<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ApplicationRepository;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationSummaryResource;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public ApplicationRepository $applicationRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function index(Request $request)
    {
        return ApplicationSummaryResource::collection($this->applicationRepository->findAll($request));
    }

    public function store(StoreApplicationRequest $request)
    {
        return new ApplicationResource($this->applicationRepository->store($request));
    }

    public function show(Request $request)
    {
        return new ApplicationResource($this->applicationRepository->findOrFail($request->route('app_id')));
    }

    public function update(UpdateApplicationRequest $request)
    {
        return new ApplicationResource($this->applicationRepository->update($request->route('app_id'), $request));
    }

    public function delete(Request $request)
    {
        $this->applicationRepository->delete($request->route('app_id'));
        return response('', 204);
    }
}
