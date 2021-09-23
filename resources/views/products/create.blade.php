@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
          <h3>Add New Product</h3>
        </div>
    </div>
</div>

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!!</strong>
       <ul>
           @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
           @endforeach
       </ul>
    </div>
@endif


<div class="row">
    <div class="form-group">
        
         <form action="{{route('products.store')}}" method="post">
            @csrf
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="">Name: </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Price: </label>
                        
                        <input type="number" step="any" class="form-control" name="price" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Coffee Origin: </label>
                        <input type="text" name="coffee_origin" class="form-control" required>
                    </div>
                </div>  
        
        <div class="col-lg-12">
            <a class="btn btn-xs btn-success" href="{{ route('products.index')}}">Back</a>
            <button type="submit" class="btn btn-xs btn-primary" name="button">Submit</button>
        </div>
    </form>
        
    </div>
</div>

       
@endsection