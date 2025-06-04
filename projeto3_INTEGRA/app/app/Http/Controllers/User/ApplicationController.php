<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\DTO\ApplicationFilterDTO;
use App\Http\Repositories\ApplicationRepository;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Resources\ApplicationSummaryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
