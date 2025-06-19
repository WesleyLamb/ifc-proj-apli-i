<?php

namespace App\Http\Repositories;

use App\Http\DTO\ApplicationFilterDTO;
use App\Http\DTO\PaginatorDTO;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Repositories\Contracts\ModuleRepositoryInterface;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public PaginatorDTO $paginator;
    public ApplicationFilterDTO $applicationFilter;

    public function __construct(Request $request)
    {
        $this->paginator = PaginatorDTO::fromRequest($request);
        $this->applicationFilter = ApplicationFilterDTO::fromRequest($request);
    }

    public function getAll(Request $request): LengthAwarePaginator
    {
        return Application::fromFilters($this->applicationFilter)->paginate($this->paginator->per_page);
    }

    public function store(StoreApplicationRequest $request): Application
    {
        $application = new Application();
        $application->name = $request->get('name');
        $application->description = $request->get('description');

        $file = Str::random(32).'.png';

        $base64_image = $request->get('logo')['data'];
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        ob_start();
        imagepng(imagecreatefromstring(base64_decode($file_data)), null);
        $file_data = ob_get_contents();
        ob_end_clean();

        Storage::put($file, $file_data);

        $application->logo_file = $file;
        $application->save();
        $application->refresh();

        $module = new Module();
        $module->application_id = $application->id;
        $module->name = 'default';
        $module->description = 'Basic features';
        $module->value = $request->get('value');


        return $application->refresh();
    }

    public function findOrFail(string $appId): Application
    {
        return Application::findOrFail($appId);
    }

    public function update(string $appId, UpdateApplicationRequest $request): Application
    {
        $model = $this->findOrFail($appId);

        $model->name = $request->get('name');
        $model->description = $request->get('description');

        if ($request->has('logo.data')) {
            $newFile = Str::random(32).'.png';

            $base64_image = $request->get('logo')['data'];
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);

            ob_start();
            imagepng(imagecreatefromstring(base64_decode($file_data)), null);
            $file_data = ob_get_contents();
            ob_end_clean();

            Storage::put($newFile, $file_data);
            $model->logo_file = $newFile;
        }

        $model->save();

        return $model->refresh();
    }

    public function delete(string $appId): bool
    {
        $model = $this->findOrFail($appId);
        $model->delete();

        return true;
    }
}