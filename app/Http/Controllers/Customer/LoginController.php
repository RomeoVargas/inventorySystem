<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::query()->where([
            ['email', '=', $email],
            ['password', '=', $password],
        ])->first();
        $message = array(
            'loginError' => 'Invalid email/password'
        );

        if ($user) {
            Auth::login($user);
            $message = array(
                'success' => 'Welcome'
            );
        }

        return redirect('/home')->with($message);
    }
}