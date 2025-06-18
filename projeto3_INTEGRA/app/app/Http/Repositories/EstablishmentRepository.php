<?php

namespace App\Http\Repositories;

use App\Http\DTO\EstablishmentFilterDTO;
use App\Http\DTO\PaginatorDTO;
use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use App\Http\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\StoreEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;
use App\Models\Establishment;
use App\Models\License;
use App\Models\UserEstablishment;
use App\Models\UserEstablishmentPermission;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Nette\NotImplementedException;

class EstablishmentRepository implements EstablishmentRepositoryInterface
{
    public PaginatorDTO $paginator;
    public EstablishmentFilterDTO $establishmentFilter;
    public UserRepository $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        $this->paginator = PaginatorDTO::fromRequest($request);
        $this->establishmentFilter = EstablishmentFilterDTO::fromRequest($request);
        $this->userRepository = $userRepository;
    }

    public function getAllOfUser(int $internalUserId, Request $request): LengthAwarePaginator
    {
        return Establishment::fromUser($internalUserId)->fromFilter($this->establishmentFilter)->paginate($this->paginator->per_page);
    }

    public function store(StoreEstablishmentRequest $request): Establishment
    {
        $establishment = new Establishment();
        $establishment->name = $request->get('name');
        $establishment->document = $request->get('document');
        $establishment->document_type = $request->get('document_type');

        $file = Str::random(32).'.png';

        $base64_image = $request->get('logo')['data'];
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        ob_start();
        imagepng(imagecreatefromstring(base64_decode($file_data)), null);
        $file_data = ob_get_contents();
        ob_end_clean();

        Storage::put($file, $file_data);

        $establishment->logo_file = $file;

        $establishment->save();

        $establishment->refresh();

        $userEstablishment = new UserEstablishment();
        $userEstablishment->user_id = Auth::user()->id;
        $userEstablishment->establishment_id = $establishment->id;
        $userEstablishment->owner = true;
        $userEstablishment->save();
        $userEstablishment->refresh();

        $userEstablishmentPermission = new UserEstablishmentPermission();
        $userEstablishmentPermission->user_establishment_id = $userEstablishment->id;
        $userEstablishmentPermission->permission = '*';
        $userEstablishmentPermission->save();

        $license = new License();
        $license->establishment_id = $establishment->id;
        $license->license_identifier = Str::random(10);
        $license->expiration_date = (new DateTimeImmutable())->add(new DateInterval('P7D'))->setTime(0, 0, 0);
        $license->save();

        return $establishment->refresh();
    }

    public function findOrFailOfUser(int $internalUserId, string $establishmentId): Establishment
    {
        return Establishment::fromUser($internalUserId)->findOrFail($establishmentId);
    }

    public function update(int $internalUserId, string $establishmentId, UpdateEstablishmentRequest $request): Establishment
    {
        $establishment = $this->findOrFailOfUser($internalUserId, $establishmentId);

        $establishment->name = $request->get('name');
        $establishment->document = $request->get('document');
        $establishment->document_type = $request->get('document_type');

        if ($request->has('logo.data')) {
            Storage::delete($establishment->logo_file);
            $file = Str::random(32).'.png';

            $base64_image = $request->get('logo')['data'];
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);

            ob_start();
            imagepng(imagecreatefromstring(base64_decode($file_data)), null);
            $file_data = ob_get_contents();
            ob_end_clean();

            Storage::put($file, $file_data);

            $establishment->logo_file = $file;
        }

        $establishment->save();
        return $establishment->refresh();
    }
}