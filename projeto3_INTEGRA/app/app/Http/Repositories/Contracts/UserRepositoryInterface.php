<?php

namespace App\Http\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findOrFail(string $userId): User;
}