<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $rules = array(
                'email'         => 'required|max:255|email|unique:users,email,'.$user->id,
                'firstName'     => 'required|min:1|max:50',
                'lastName'      => 'required|min:1|max:50',
                'contactNumber' => 'required|digits_between:7,11',
                'address'       => 'required',
                'company'       => 'min:0|max:50'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('edit-profile')
                    ->withErrors($validator)
                    ->withInput();
            }

            $previousCompany = $user->company;
            $user->fill([
                'email'             => $request->get('email'),
                'first_name'        => $request->get('firstName'),
                'last_name'         => $request->get('lastName'),
                'contact_number'    => $request->get('contactNumber'),
                'address'           => $request->get('address'),
                'company'           => $request->get('company')
            ])->save();
            $message = array('success' => 'Your profile has been updated');

            if ($previousCompany != $user->company) {
                $notifMessage = ($user->company)
                    ? 'Customer '. $user->getFullName() .' is now affiliated to ' . $user->company
                    : 'Customer '. $user->getFullName() . ' is now using an individual account';

                $notification = new Notification();
                $notification->fill([
                    'type' => Notification::TYPE_NEW_CUSTOMER_AFFILIATION,
                    'content' => $notifMessage,
                    'link' => 'accounts?forCustomers=1'
                ])->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect('edit-profile')->with($message);
    }

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