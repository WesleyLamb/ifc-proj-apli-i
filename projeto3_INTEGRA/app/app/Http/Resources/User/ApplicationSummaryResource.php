<?php

namespace App\Http\Resources\User;

use App\Http\Repositories\Contracts\EstablishmentRepositoryInterface;
use App\Http\Repositories\EstablishmentRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ApplicationSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'value' => (float)$this->modules()->first()->value,
            'logo_url' => $this->getLogoUrl(),
            'adquired' => $this->when($request->query('establishment_id'), function() use ($request) {
                $establishmentRepository = App::make(EstablishmentRepositoryInterface::class);
                return $establishmentRepository->findOrFailOfUser(Auth::user()->id, $request->query('establishment_id'))->licenses()->first()->applications()->where('application_id', $this->id)->exists();
            })
        ];
    }
}
