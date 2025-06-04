<?php

namespace App\Http\Repositories;

use App\Http\DTO\ApplicationFilterDTO;
use App\Http\DTO\PaginatorDTO;
use App\Http\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
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

    public function findAll(Request $request): LengthAwarePaginator
    {
        return Application::fromFilters($this->applicationFilter)->paginate($this->paginator->per_page);
    }

    public function store(StoreApplicationRequest $request): Application
    {
        $model = new Application();
        $model->name = $request->get('name');
        $model->description = $request->get('description');

        $file = Str::random(32).'.png';

        Storage::put($file, base64_decode($request->get('logo')['data']));

        $model->logo_file = $file;
        $model->save();

        return $model->refresh();
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

            Storage::delete($model->logo_file);
            Storage::put($newFile, base64_decode($request->get('logo')['data']));
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