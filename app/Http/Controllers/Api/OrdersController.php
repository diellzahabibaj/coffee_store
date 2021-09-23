<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Product;
use App\Http\Resources\OrdersResource;

class OrdersController extends Controller
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
      
        $orders = Order::with('products')->get();
        return response()->json($orders);


     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    

       $orders = Order::all();
        $customers = Customer::all();
        $products = Product::all();
       
        return  response()->json([$orders, $customers,$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $order = new Order;
        $order->customer_id = $request->customer_id;

        $order->order_time = $request->order_time;
        $order->total = $request->total;
        $order->user_id = auth()->user()->id;
        $order->save();
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        $amount = $request->input('amount', []);
        for ($product=0; $product < count($products); $product++) {
           if ($products[$product] != '') {
                $order->products()->attach($products[$product], 
                ['quantity' => $quantities[$product],
                'amount' => $amount[$product]]);
            }
         }
        return  response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orders = Order::all();
        return  response()->json($order);
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
        $order = Order::find($id);
      
        $order->delete();
        return response()->json('Order deleted');
    }

}
