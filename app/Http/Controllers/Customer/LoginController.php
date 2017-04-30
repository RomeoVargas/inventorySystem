<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Notification;
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
            'address'               => 'required',
            'company'               => 'min:0|max:50'
        ]);

        $user = new User();
        $user->fill([
            'email'             => $request->get('email'),
            'password'          => md5($request->get('password')),
            'auth_type'         => User::AUTH_TYPE_CUSTOMER,
            'first_name'        => $request->get('firstName'),
            'last_name'         => $request->get('lastName'),
            'contact_number'    => $request->get('contactNumber'),
            'address'           => $request->get('address'),
            'company'           => $request->get('company')
        ])->save();

        $notifMessage = ($user->company)
            ? $user->getFullName() . ' have registered an account for '.$user->company
            : $user->getFullName() . ' have registered an individual account';

        $notification = new Notification();
        $notification->fill([
            'type' => Notification::TYPE_NEW_CUSTOMER,
            'content' => $notifMessage,
            'link' => 'accounts?forCustomers=1'
        ])->save();

        return redirect('/home')->with('success', 'Your account has been submitted for assessment! You will receive an email if your account is ready for login');
    }
}