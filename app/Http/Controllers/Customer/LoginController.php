<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $message = array();
        if (!Auth::user()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $user = UserService::authenticate($email, $password);
            $message = array(
                'loginError' => 'Invalid email/password'
            );

            if ($user) {
                Auth::login($user);
                $message = array(
                    'success' => 'Welcome'
                );
            }
        }

        return redirect('/home')->with($message);
    }

    public function logout()
    {
        $message = array();
        if (!Auth::user()) {
            $message = array(
                'loginError' => 'You are already logged out'
            );
        } else {
            Auth::logout();
        }

        return redirect('/home')->with($message);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'email'                 => 'required|unique:users|max:255',
            'password'              => 'required|min:8|max:16|confirmed',
            'password_confirmation' => 'required|min:8|max:16',
            'firstName'             => 'required|min:1|max:50',
            'lastName'              => 'required|min:1|max:50',
            'contactNumber'         => 'required|digits_between:7,10',
            'address'               => 'required'
        ]);

        $user = new User();
        $user->email = $request->get('email');
        $user->password = md5($request->get('password'));
        $user->auth_type = User::AUTH_TYPE_CUSTOMER;
        $user->first_name = $request->get('firstName');
        $user->last_name = $request->get('lastName');
        $user->contact_number = $request->get('contactNumber');
        $user->address = $request->get('address');
        $user->save();

        return redirect('/home')->with('success', 'You are now successfully registered. You can now log in!');
    }
}