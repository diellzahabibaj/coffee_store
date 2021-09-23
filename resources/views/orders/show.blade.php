@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
    <h4>Show order</h4> <a class="btn btn-xs btn-primary" href="{{ route('orders.index')}}">Show all</a>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>product : </strong>
                @foreach ($order->products as $product)
                    {{$product->name}}
                @endforeach
                
            </div>
        </div>
       
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>customer : </strong>
                    {{ $order->customer->first_name}}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Amount : </strong>
                    @foreach ($order->products as $product)
                    {{$product->price}}
                @endforeach
                </div>
            </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <strong>order_time : </strong>
                        {{ $order->order_time}}
                    </div>
                 </div>
     </div>
    
@endsection