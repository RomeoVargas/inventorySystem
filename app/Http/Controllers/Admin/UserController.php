<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Services\Session;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
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
}