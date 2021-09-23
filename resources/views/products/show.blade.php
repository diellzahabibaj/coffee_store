@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
    <h4>Show product</h4> <a class="btn btn-xs btn-primary" href="{{ route('products.index')}}">Show all</a>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Name : </strong>
                {{ $product->name}}
            </div>
        </div>
       
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Price : </strong>
                    {{ $product->price}}
                </div>
            </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <strong>Coffee Origin : </strong>
                        {{ $product->coffee_origin}}
                    </div>
                 </div>
     </div>
    
@endsection