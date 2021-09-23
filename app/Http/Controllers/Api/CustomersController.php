<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CustomersResource;
use Illuminate\Support\Str;
use App\User;
use App\Mail\VerificationEmail;
use Mail;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin', ['except' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $customers = Customer::all();
        return response()->json($customers);

       // $customers = Customer::orderBy('last_name', 'desc')->get();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $customer = Customer::findOrFail($id);
      return response()->json($customer);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message'=>'Customer deleted']);

    }
}