<?php

namespace App\Http\Repositories;

use App\Http\DTO\LicenseFilterDTO;
use App\Http\DTO\PaginatorDTO;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Repositories\Contracts\LicenseRepositoryInterface;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Requests\StoreLicenseApplicationRequest;
use App\Models\License;
use App\Models\LicenseApplication;
use App\Models\LicenseApplicationModule;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class LicenseRepository implements LicenseRepositoryInterface
{
    public PaginatorDTO $paginator;
    public LicenseFilterDTO $establishmentFilter;
    public ApplicationRepository $applicationRepository;
    public ModuleRepository $moduleRepository;

    public function __construct(Request $request, ApplicationRepositoryInterface $applicationRepository, ModuleRepositoryInterface $moduleRepository)
    {
        $this->paginator = PaginatorDTO::fromRequest($request);
        $this->establishmentFilter = LicenseFilterDTO::fromRequest($request);
        $this->applicationRepository = $applicationRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getAll(int $internalEstablishmentId): LengthAwarePaginator
    {
        return License::fromEstablishment($internalEstablishmentId)->fromFilter($this->establishmentFilter)->paginate();
    }

    public function findOrFailOfEstablishment(int $internalEstablishmentId, string $licenseId): License
    {
        return License::fromEstablishment($internalEstablishmentId)->findOrFail($licenseId);
    }

    private function findOrFail(int $internalLicenseId)
    {
        return License::where('id', $internalLicenseId)->firstOrFail();
    }

    public function addApplication(int $internalLicenseId, StoreLicenseApplicationRequest $request): License
    {
        $license = $this->findOrFail($internalLicenseId);
        $application = $this->applicationRepository->findOrFail($request->get('application_id'));
        $modules = $request->get('modules');
        foreach ($modules as $module) {
            $mod = $this->moduleRepository->findOrFail($application->id, $module);
        }

        if (LicenseApplication::where('license_id', $license->id)->where('application_id', $application->id)->first()) {
            throw new BadRequestException('This license already have this application');
        }

        $licenseApplication = new LicenseApplication();
        $licenseApplication->license_id = $license->id;
        $licenseApplication->application_id = $license->id;
        $licenseApplication->save();
        $licenseApplication->refresh();

        foreach ($modules as $module) {
            $licenseApplicationModule = new LicenseApplicationModule();
            $licenseApplicationModule->license_application_id = $licenseApplication->id;
            $licenseApplicationModule->module_id = $this->moduleRepository->findOrFail($application->id, $module)->id;
            $licenseApplicationModule->save();
        }

        return $license->refresh();
    }
}