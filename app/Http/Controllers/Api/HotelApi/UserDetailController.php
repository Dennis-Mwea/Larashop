<?php

namespace Larashop\Http\Controllers\Api\HotelApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\UserDetail;

class UserDetailController extends Controller
{
    public function updateUserDetails(Request $request) {
    	$this->validate($request, [
    		'user_id' => 'required',
    		'name' => 'required',
    		'phone_number' => 'required',
    		'email' => 'required',
    		'address' => 'required',
    		'country' => 'required',
    		'zip' => 'required',
    		'city' => 'required',
    		'state' => 'required',
    	]);

        $user = Auth::user();

        if ($user != null) {
            if ($user->email == $request->input('email')) {
                UserDetail::where('user_id', $request->input('user_id'))
                            ->update([
                                'name' => $request->input('name'),
                                'phone_number' => $request->input('phone_number'),
                                'email' => $user->email,
                                'address' => $request->input('address'),
                                'country' => $request->input('country'),
                                'zip' => $request->input('zip'),
                                'city' => $request->input('city'),
                                'state' => $request->input('state'),
                            ]);
                $userDetails = UserDetail::findOrFail($request->input('user_id'))->get();

                return response()->json($userDetails, 200, [], JSON_NUMERIC_CHECK);
            } else {
                return response()->json("User email is different", 200, [], JSON_NUMERIC_CHECK);
            }
        } else {
            $userDetails = UserDetail::create([
                'user_id' => $user = Auth::user()->id,
                'name' => request('name'),
                'phone_number' => request('phone_number'),
                'email' => $user = Auth::user()->email,
                'address' => request('address'),
                'country' => request('country'),
                'zip' => request('zip'),
                'city' => request('city'),
                'state' => request('state'),
            ]);

            return response()->json($userDetails, 200, [], JSON_NUMERIC_CHECK);
        }
    }
    
    
}
