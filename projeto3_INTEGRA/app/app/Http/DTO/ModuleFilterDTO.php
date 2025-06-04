<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;

class ModuleFilterDTO
{
    public ?string $q = null;

    public static function fromRequest(Request $request)
    {
        $dto = new self();

        if ($request->query('q')) {
            $dto->q = $request->query('q');
        }

        return $dto;
    }
}