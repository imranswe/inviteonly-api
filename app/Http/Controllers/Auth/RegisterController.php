<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserPin;
use App\Http\Requests\SignupRequest;
use App\Events\UserSignupEvent;

class UserController extends Controller
{
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(SignupRequest $request) 
    {
        try {
            $userData = $request->all();
            $userData['password'] = bcrypt($userData['password']);
            $userData['registered_at'] = date('Y-m-d H:i:s');
            $user = User::create($userData); 
            $userPin = new UserPin(['code' => mt_rand(100000, 999999)]); 
            $user->userPin()->save($userPin);
            event(new UserSignupEvent($user));
            return response()->json([
                'success'=> true, 
                'verify_url'=>route('email/verify/'.$user->id),
                'message'=>'A 6 digit pin has been sent to your email!'
            ], 200);
        }
        catch(Exeption $e){
            return response()->json(['success'=> false, 'message'=>$e->getMessage()], 401);
        }
    }
}
