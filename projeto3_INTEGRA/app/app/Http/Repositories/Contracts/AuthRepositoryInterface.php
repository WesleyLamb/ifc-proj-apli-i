<?php

namespace App\Http\Repositories\Contracts;

use App\Http\DTO\LoginResponseDTO;
use App\Http\DTO\UserWithLoginResponseDTO;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function register(Request $request): UserWithLoginResponseDTO;
    public function login(Request $request): LoginResponseDTO;
    public function refresh(Request $request): LoginResponseDTO;
    public function logout(): bool;
}