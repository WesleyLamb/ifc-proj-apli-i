<?php

namespace App\Http\Repositories;

use App\Exceptions\AuthException;
use App\Http\DTO\LoginResponseDTO;
use App\Http\DTO\UserWithLoginResponseDTO;
use App\Http\Repositories\Contracts\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Client;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AuthRepository implements AuthRepositoryInterface
{
    public TokenRepository $tokenRepository;
    public RefreshTokenRepository $refreshTokenRepository;

    public function __construct()
    {
        $this->tokenRepository = app(TokenRepository::class);
        $this->refreshTokenRepository = app(RefreshTokenRepository::class);
    }

    public function register(Request $request): UserWithLoginResponseDTO
    {
        // TODO: register user
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return UserWithLoginResponseDTO::fromRegister($user->refresh(), $this->login($request));
    }

    public function login(Request $request): LoginResponseDTO
    {
        $client = Client::where('password_client', 1)->first();

        $http = Http::asForm()->post('http://auth.pgs/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->get('username') ?? $request->get('email'),
            'password' => $request->get('password'),
            'scope' => '*',
        ]);

        if ($http->status() != 200) {
            Log::error('Error trying to authenticate ' . $request->get('username') . ': ' . json_encode($http->json()));
            throw new AuthException('Unable to authenticate, try again later.', 101);
        }
        return LoginResponseDTO::fromResponseJson($http->json());
    }

    public function refresh(Request $request): LoginResponseDTO
    {
        $client = Client::where('password_client', 1)->first();

        $http = Http::asForm()->post('http://auth.pgs/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->get('refresh_token'),
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '*',
        ]);


        if ($http->status() != 200) {
            Log::error('Error trying to refresh ' . $request->get('username') . ': ' . json_encode($http->json()));
            throw new AuthException('Unable to refresh token, try again later.', 101);
        }

        return LoginResponseDTO::fromResponseJson($http->json());
    }

    public function logout(): bool
    {
        $tokenId = Auth::user()->token()->id;
        $this->tokenRepository->revokeAccessToken($tokenId);
        // Revoke all of the token's refresh tokens...

        $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);

        return true;
    }
}