<?php

namespace App\Services;

use App\User;

class UserService
{
    public static function authenticate($email, $password, $authType = User::AUTH_TYPE_CUSTOMER)
    {
        return User::query()->where([
            ['email', '=', $email],
            ['password', '=', md5($password)],
            ['auth_type', '=', $authType]
        ])->first();
    }
}