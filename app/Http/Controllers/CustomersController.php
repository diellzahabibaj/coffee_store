<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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


       // $customers = Customer::orderBy('last_name', 'desc')->get();
        return view('customers.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('customers.create',['customers'=>$customers]);
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

        $user = new User();
        $user->name = $customer->first_name . ' ' .$customer->last_name;
        $user->role = 'customer';
        $user->password = Hash::make($request->password);
        $user->customer_id = $customer->id;
        $user->email = $request->email;
        //$user->verify_token = ramdom generator string
        $user->save();
        

        





        return redirect()->route('customers.index')->with('success','Customer created!');
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
      $customers = Customer::all();
      return view('customers.show', ['customers'=>$customers, 'customer'=>$customer]);
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
        return redirect()->route('customers.index')->with('success','Customer deleted');

    }
}
