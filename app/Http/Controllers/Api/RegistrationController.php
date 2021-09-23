<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Mail\VerificationEmail;
use Mail;

class RegistrationController extends Controller
{

  public function register(Request $request)
  {
     

      request()->validate([
          'first_name'=>'required',
          'last_name'=>'required',
          'gender'=>'required',
          'phone_number'=>'required',
      ]);
      //Product::create($request->all());

      $customer = new Customer();
      $customer->first_name = $request->first_name;
      $customer->last_name = $request->last_name;
      $customer->gender = $request->gender;
      $customer->phone_number = $request->phone_number;

      $customer->save();

      /*$user = new User();
      $user->name = $customer->first_name . ' ' . $customer->last_name;
      $user->role = 'customer';
      $user->password = Hash::make($request->password);
      $user->customer_id = $customer->id;
      $user->email = $request->email;
      $user->token = Str::random(60);
      //$user->verify_token = ramdom generator string
      $user->sendEmailVerificationNotification();
      $user->save();*/


      $user = new User();
        //$user->name = $request->name;
        $user->name = $customer->first_name . ' ' . $customer->last_name;
        $user->role = 'customer';
        $user->password = bcrypt($request->password);
       //$user->customer_id = $request->customer_id;
        $user->customer_id = $customer->id;
        $user->email = $request->email;
        $user->token = sha1(time());
        //$user->verify_token = ramdom generator string
        
        $user->save();
        Mail::to($user->email)->send(new VerificationEmail($user));
      return response()->json(['message'=>'Please check your email to verifys your account']);

      //return response()->json(['message'=>'User has been created']);
      //return redirect()->route('customers.index')->with('success','Customer created!');
  }


    /*public function register(Request $request){
       /* $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
          ])->sendEmailVerificationNotification();

          $user = new User();
          $user->name = $request->name;
          $user->role = 'customer';
          $user->password = bcrypt($request->password);
          $user->customer_id = $request->customer_id;
          $user->email = $request->email;
          $user->token = sha1(time());
          //$user->verify_token = ramdom generator string
          
          $user->save();
        return response()->json(['message'=>'User has been created']);
    }*/
}
