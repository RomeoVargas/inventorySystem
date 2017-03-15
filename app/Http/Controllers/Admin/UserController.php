<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AccountCredentials;
use App\Mail\DeletedAccount;
use App\Services\Session;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserController extends BaseController
{
    const INIT_PASSWORD_LENGTH = 8;

    private function validateRequest(Request $request)
    {
        $adminId = null;
        $rules = array(
            'email'         => 'required|max:255|email|unique:users,email',
            'firstName'     => 'required|min:1|max:50',
            'lastName'      => 'required|min:1|max:50',
            'contactNumber' => 'required|digits_between:7,10',
        );

        if ($request->get('id')) {
            $adminId = Session::get('admin')->id;
            $rules['email'] .= ','.$adminId;
        }

        return Validator::make($request->all(), $rules);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin = $request->get('id') ? Session::get('admin') : new User();
            $validator = $this->validateRequest($request);

            if ($validator->fails()) {
                return $this->redirectTo('accounts')
                    ->with(['userId' => $admin->id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $email = $request->get('email');
            if (!$admin->id) {
                $newPassword = substr(strtoupper(md5(str_random(self::INIT_PASSWORD_LENGTH))), -self::INIT_PASSWORD_LENGTH);
                $admin->password = md5($newPassword);
                $admin->auth_type = User::AUTH_TYPE_ADMIN;
                Mail::to($email)->send(new AccountCredentials($email, $newPassword));
            }

            $admin->fill([
                'email'             => $email,
                'first_name'        => $request->get('firstName'),
                'last_name'         => $request->get('lastName'),
                'contact_number'    => $request->get('contactNumber'),
                'address'           => ''
            ])->save();

            $message = array('success' => 'Your profile has been updated');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('accounts')->with($message);
    }

    public function changePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin = Session::get('admin');
            $rules = array(
                'oldPassword'       => [
                    'required',
                    Rule::exists('users','password')->where('id', $admin->id)
                ],
                'password'          => 'required|min:8|max:16',
                'confirmPassword'   => 'required|same:password'
            );

            $requestFields = $request->all();
            $requestFields['oldPassword'] = md5($requestFields['oldPassword']);

            $validator = Validator::make($requestFields, $rules);
            if ($validator->fails()) {
                return $this->redirectTo($requestFields['urlFrom'])
                    ->with(['passwordUserId' => $admin->id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $admin->password = md5($requestFields['password']);
            $admin->save();
            $message = array('success' => 'Your password has been updated');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo($request->get('urlFrom'))->with($message);
    }

    public function index()
    {
        $admin = Session::get('admin');
        $users = User::query()
            ->whereIn('auth_type', [User::AUTH_TYPE_ADMIN, User::AUTH_TYPE_SUPER_ADMIN])
            ->where('id', '!=', $admin->id)
            ->orderBy('auth_type', 'desc')
            ->get();

        return view('admin.accounts')->with([
            'users' => $users,
            'admin' => $admin
        ]);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $admin = Session::get('admin');
            if ($admin->id == $id || !$admin->isSuperAdmin()) {
                throw new AccessDeniedHttpException('You are now allowed to do this action');
            }

            if ((!$user = User::find($id)) || $user->auth_type == User::AUTH_TYPE_CUSTOMER) {
                throw new ModelNotFoundException('Admin does not exist');
            }

            $message = array('success' => 'Admin '.$user->getFullName().' has been successfully deleted');
            Mail::to($user->email)->send(new DeletedAccount());
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('accounts')->with($message);
    }

    public function resetPassword($id)
    {
        DB::beginTransaction();
        try {
            $admin = Session::get('admin');
            if ($admin->id == $id || !$admin->isSuperAdmin()) {
                throw new AccessDeniedHttpException('You are now allowed to do this action');
            }

            if ((!$user = User::find($id)) || $user->auth_type == User::AUTH_TYPE_CUSTOMER) {
                throw new ModelNotFoundException('Admin does not exist');
            }

            $email = $user->email;
            $newPassword = substr(strtoupper(md5(str_random(self::INIT_PASSWORD_LENGTH))), -self::INIT_PASSWORD_LENGTH);
            $user->password = md5($newPassword);
            $user->save();

            Mail::to($email)->send(new AccountCredentials($email, $newPassword));
            $message = array('success' => 'New password has been sent to the email of '.$user->getFullName());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('accounts')->with($message);
    }
}