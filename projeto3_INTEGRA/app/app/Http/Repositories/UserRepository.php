<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findOrFail(string $userId): User
    {
        return User::where('uuid', $userId)->firstOrFail();
    }
}