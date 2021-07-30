<?php

namespace App\Repository;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

interface UserRepositoryInterface
{
    public function storeUser(StoreUserRequest $request);

    public function createAuthToken($model);

    public function loginUser(LoginUserRequest $request);
}
