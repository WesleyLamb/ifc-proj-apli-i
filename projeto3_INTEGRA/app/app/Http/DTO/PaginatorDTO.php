<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;

class PaginatorDTO
{
    public int $per_page;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();
        $dto->per_page = $request->query('per_page') ?? 15;

        return $dto;
    }
}