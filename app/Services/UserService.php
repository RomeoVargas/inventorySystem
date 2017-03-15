<?php

namespace App\Services;

use App\User;

class UserService
{
    public static function authenticate($email, $password, $authType = User::AUTH_TYPE_CUSTOMER)
    {
        $userQuery = User::query()->where([
                ['email', '=', $email],
                ['password', '=', md5($password)]
        ]);
        if (is_array($authType)) {
            $userQuery->whereIn('auth_type', $authType);
        } else {
            $userQuery->where('auth_type', '=', $authType);
        }

        return $userQuery->first();
    }
}