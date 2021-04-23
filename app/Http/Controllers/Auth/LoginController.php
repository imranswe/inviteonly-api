<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(LoginRequest $request){ 
        try {
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                $user = Auth::user(); 
                $token =  $user->createToken('MyApp')->accessToken; 
                return response()->json(['success'=> true,'message'=>'Authenticated successfully!','token' => $token], 200);
            } 
            else{ 
                return response()->json(['success'=> false,'message'=>'Unauthorised'], 401); 
            }
        }
        catch(Exception $e){
            return response()->json(['success'=> true,'message'=>$e->getMessage()], 403); 
        }
    }

    public function authenticated(Request $request, $user) {
        if (!$user->email_verified_at) {
            auth()->logout();
            return response()->json(['success'=> true,'message'=>'Your email is not verified'], 403); 
        }
        return;
    }
}
