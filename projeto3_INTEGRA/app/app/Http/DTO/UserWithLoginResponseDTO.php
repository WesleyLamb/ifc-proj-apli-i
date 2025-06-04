<?php

namespace App\Http\DTO;

use App\Models\User;

class UserWithLoginResponseDTO
{
    public User $user;
    public LoginResponseDTO $auth;

    public static function fromRegister(User $user, LoginResponseDTO $dto): self
    {
        $self = new self();
        $self->user = $user;
        $self->auth = $dto;

        return $self;
    }
}