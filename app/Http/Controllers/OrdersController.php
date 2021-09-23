<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Customer;
use App\Product;




class OrdersController extends Controller
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
      /* $order = Order::find(1);

        echo $order->customer->first_name;

       /* $order = Order::find(1);

foreach ($order->products as $product) {
    $product->name;
}*/
        $orders = Order::with('products')->get();
        //return response()->json($orders);


      // $products = Order::find(1)->products()->orderBy('name')->get();
     

       
    //return view('orders.index', compact('orders'));

        /*$orders = Order::all();*/
        return view('orders.index', compact('orders'));
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
       
        return view('orders.create', compact('orders','customers', 'products'));
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

        /*$order = Order::create([
             'customer_id' => customer()->id,
           'total' =>$request->total,
            'order_time'=>$request->order_time,
        ]);

        $products = $request->input('products',[]);
        $quantity = $request->input('quantity',[]);
        
        $order->products()->attach([$request['products'] => ['quantity' => $request[$quantity]]]);*/
        
        

        /*$order = Order::create($request->all());

    $products = $request->input('products', []);
    $quantity = $request->input('quantity', []);
   
    $order->products()->attach([$request['products'] => ['quantity' => $request['quantity']]]);*/
       
    
       /* $order = Order::create($request->all());

    $products = $request->input('products');
    $quantity = $request->input('quantity');
    
    
    $order->products()->attach(['products'=>$products,  'quantity' => $quantity]);
        
    

    /*return redirect()->route('admin.orders.index');
    
        //Product::create($request->all());

       // $order = new Order;*/
        //$order = Order::create($request->all());
      
        

        //$order->save();

        //$order->products()->sync($request->products, false);
        // $order->products()->sync($request->products, false);



        return redirect()->route('orders.index')->with('success','Order created!');
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
        return view('orders.show', ['orders'=>$orders, 'order'=>$order]);
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
        return redirect()->route('orders.index')->with('success','Order deleted');
    }
}
