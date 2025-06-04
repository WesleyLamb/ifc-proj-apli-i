<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\Contracts\AuthRepositoryInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public AuthRepository $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(StoreUserRequest $request)
    {
        $dto = $this->authRepository->register($request);

        return (new UserResource($dto->user))->additional(
            // Return auth token with the user
            $dto->auth->json,
        );
    }

    public function login(LoginRequest $request)
    {
        return response()->json($this->authRepository->login($request)->json);
    }

    public function refresh(RefreshTokenRequest $request)
    {
        return response()->json($this->authRepository->refresh($request)->json);
    }

    public function logout(Request $request)
    {
        $this->authRepository->logout();

        return response('', 204);
    }
}
