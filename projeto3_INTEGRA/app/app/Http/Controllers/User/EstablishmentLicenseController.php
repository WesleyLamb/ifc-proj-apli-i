<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use App\Http\Repositories\Contracts\LicenseRepositoryInterface;
use App\Http\Repositories\EstablishmentRepository;
use App\Http\Repositories\LicenseRepository;
use App\Http\Requests\StoreLicenseApplicationRequest;
use App\Http\Resources\User\LicenseResource as UserLicenseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablishmentLicenseController extends Controller
{
    public LicenseRepository $licenseRepository;
    public EstablishmentRepository $establishmentRepository;

    public function __construct(EstablishmentRepositoryInterface $establishmentRepository, LicenseRepositoryInterface $licenseRepository)
    {
        $this->licenseRepository = $licenseRepository;
        $this->establishmentRepository = $establishmentRepository;
    }

    public function index(Request $request)
    {
        return UserLicenseResource::collection($this->licenseRepository->getAll($this->establishmentRepository->findOrFailOfUser(Auth::user()->id, $request->route('establishment_id'))->id));
    }

    public function show(Request $request)
    {
        return new UserLicenseResource($this->licenseRepository->findOrFailOfEstablishment($this->establishmentRepository->findOrFailOfUser(Auth::user()->id, $request->route('establishment_id'))->id, $request->route('license_id')));
    }

    public function addApplication(StoreLicenseApplicationRequest $request)
    {
        return new UserLicenseResource($this->licenseRepository->addApplication(
            $this->licenseRepository->findOrFailOfEstablishment(
                $this->establishmentRepository->findOrFailOfUser(
                    Auth::user()->id, $request->route('establishment_id'))->id,
                    $request->route('license_id')
                )->id,
            $request));
    }
}
