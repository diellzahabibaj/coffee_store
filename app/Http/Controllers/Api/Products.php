<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductsResource;

class Products extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'isAdmin']);
    }

    public function index()
    {
       // return ProductsResource::collection(Product::all());

        $products = Product::all();
        return response()->json($products);
    }

    public function create()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
     
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->coffee_origin = $request->coffee_origin;
        
        $product->save();
        return response()->json($product);
    }
    
    public function show($id)
    {
      $product = Product::findOrFail($id);
      return response()->json($product);
      
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->coffee_origin = $request->coffee_origin;
        
        $product->save();
        return response()->json($product);
    }

    
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}

