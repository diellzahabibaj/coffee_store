<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Product;
use App\Order;
use App\Customer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         return view('home');

   /*$users = DB::table('users')
            ->join('customers', 'users.customer_id', '=', 'customers.id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'customers.gender', 'orders.total')
            ->get();
        //return view('home');
        return  response()->json($users);*/
    }

    public function getUser(){
        return response()->json(auth()->user());
    }
}
