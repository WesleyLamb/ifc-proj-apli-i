<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use App\Http\Repositories\EstablishmentRepository;
use App\Http\Requests\StoreEstablishmentRequest;
use App\Http\Resources\User\EstablishmentSummaryResource as UserEstablishmentSummaryResource;
use App\Http\Resources\User\EstablishmentResource as UserEstablishmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablishmentController extends Controller
{
    public EstablishmentRepository $establishmentRepository;

    public function __construct(EstablishmentRepositoryInterface $establishmentRepository)
    {
        $this->establishmentRepository = $establishmentRepository;
    }

    public function index(Request $request)
    {
        return UserEstablishmentSummaryResource::collection($this->establishmentRepository->getAllOfUser(Auth::user()->id, $request));
    }

    public function store(StoreEstablishmentRequest $request)
    {
        return new UserEstablishmentResource($this->establishmentRepository->store($request));
    }

    public function show(Request $request)
    {
        return new UserEstablishmentResource($this->establishmentRepository->findOrFailOfUser(Auth::user()->id, $request));
    }
}
