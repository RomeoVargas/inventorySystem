<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $rules = array(
                'oldPassword'       => [
                    'required',
                    Rule::exists('users','password')->where('id', $user->id)
                ],
                'password'          => 'required|min:8|max:16',
                'confirmPassword'   => 'required|same:password'
            );

            $requestFields = $request->all();
            $requestFields['oldPassword'] = md5($requestFields['oldPassword']);

            $validator = Validator::make($requestFields, $rules);
            if ($validator->fails()) {
                return redirect($requestFields['urlFrom'])
                    ->with(['passwordUserId' => $user->id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->password = md5($requestFields['password']);
            $user->save();
            $message = array('success' => 'Your password has been updated');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect($request->get('urlFrom'))->with($message);
    }
}