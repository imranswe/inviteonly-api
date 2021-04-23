<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Verified; 
use Illuminate\Http\Request;
use App\Models\UserPin;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($userId, Request $request) {
        if (!$request->has('code')) {
            return response()->json(["message" => "Request must have verification code!"], 401);
        }
        
        $userPin = UserPin::where(['code'=> $request->code, 'user_id'=> $userId])->first();
        if(!$userPin){
            return response()->json(["message" => "Invalid url or pin."], 401);
        }
        $user = User::findOrFail($userId);
        
        if (!$user->hasVerifiedEmail()) {
            if($user->markEmailAsVerified()){
                event(new Verified($user));
            }
            return response()->json(["message" => "Your email has been verified!"], 200);
        }

        return response()->json(["message" => "Your email has already been verified!"], 200);
    }
}
