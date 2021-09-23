<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use App\User;


class VerificationController extends Controller
{
    public function verify($token)
    {
       /* $verify_token = User::where('token', $token)->first();
         if (!is_null($verify_token)) {
             $user = User::find($verify_token->$user_id);
             if (!$user->email_verified_at == null ){
                return response()->json(['message'=>'User already verified']);  
             }
             $user->update(['email_verified_at' => Carbon::now()]);

             $verify_token = User::where('token', $token)->delete();
             return response()->json(['message'=>'User successfully verified']);  
            
         }

         return response()->json(['message'=>'Invalid token']);  */
            


     


       $user = User::where('token',$token)->first();

       if (!is_null($user)) {
         $user->update([
            'token' => null
         ]);
        return response()->json(['message'=>'Your account is verified, you can log in now']);  
       }
       

       if($user == null ){
           return response()->json(['message'=>'User is verified']);  
       }

       
        return response()->json(['message'=>'User is not verified yet']);  

       /* 
        

         $user = User::where('token', $token)->first();

        // \user where verify\-token, $token/

        // e bon tokenin null, qajo ibjen qe osht verified
        
        // $user = User::findOrFail($user_id);

        // if (!$user->hasVerifiedEmail()){
        //     $user->markEmailAsVerified();
        // }
        // return response()->json(['message'=>'Successfully verified']);*/
    }


    
}
