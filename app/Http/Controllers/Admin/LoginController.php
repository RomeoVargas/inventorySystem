<?php

namespace App\Http\Controllers\Admin;

use App\Services\Session;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    public function authenticate(Request $request)
    {
        $message = array();
        if (!Session::get('admin')) {
            $email = $request->get('email');
            $password = $request->get('password');

            $user = UserService::authenticate($email, $password, User::AUTH_TYPE_ADMIN);
            $message = array(
                'loginError' => 'Invalid email/password'
            );

            if ($user) {
                Session::set(['admin' => $user]);
            }
        }

        return $this->redirectTo('home')->with($message);
    }

    public function logout()
    {
        $message = array();
        if (!Session::get('admin')) {
            $message = array(
                'loginError' => 'You are already logged out'
            );
        } else {
            Session::clear();
        }

        return $this->redirectTo('login')->with($message);
    }
}