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
        $urlTo = 'home';
        $message = array();
        if (!Session::get('admin')) {
            $email = $request->get('email');
            $password = $request->get('password');

            $user = UserService::authenticate($email, $password, [User::AUTH_TYPE_ADMIN, User::AUTH_TYPE_SUPER_ADMIN]);
            if (!$user) {
                $message = array(
                    'loginError' => 'Invalid email/password'
                );
                $urlTo = 'login';
            }

            Session::set(['admin' => $user]);
        }

        return $this->redirectTo($urlTo)->with($message);
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