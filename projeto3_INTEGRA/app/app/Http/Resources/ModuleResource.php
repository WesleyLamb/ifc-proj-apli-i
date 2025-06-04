<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'description' => $this->description,
            'value' => (float)$this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logo' => [
                'url' => $this->getLogoUrl()
            ],
            'scopes' => $this->scopes->pluck('scope')->toArray()
        ];
    }
}
