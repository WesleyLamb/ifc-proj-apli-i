<?php

namespace App\Http\DTO;

class LoginResponseDTO
{
    public array $json;
    public static function fromResponseJson(array $json): self
    {
        $self = new self();
        $self->json = $json;

        return $self;
    }
}