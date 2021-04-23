<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserPin;
use App\Http\Requests\SignupRequest;
use App\Events\UserSignupEvent;

class UserController extends Controller
{
    /** 
     * update profile api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function update(Request $request) 
    { 
        $userData = $request->except(['avatar']);
        if($request->hasFile('avatar')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $userData['avatar'] = $filename;
        }
        if($request->has('password')){
            $userData['password'] = bcrypt($userData['password']);
        }
        if(Auth()->user()->update($userData)){
            return response()->json(['success' => true, 'user'=>Auth::user()], 200); 
        }
        else {
            return response()->json(['success' => false, 'message'=>'Unable to update profile info!'], 422); 
        }
    } 
}
