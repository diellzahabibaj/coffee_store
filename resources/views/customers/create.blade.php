@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
          <h3>Add New Customer</h3>
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
        
         <form action="{{route('customers.store')}}" method="post">
            @csrf
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="">First Name: </label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Last Name: </label>
                        <input type="text" name="last_name" class="form-control" required>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="male">Gender: </label>
                        <input type="gender" name="gender" class="form-control" required>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Phone number: </label>
                        <input type="number" name="phone_number" class="form-control" required>
                    </div>
                </div> 
        
        <div class="col-lg-12">
            <a class="btn btn-xs btn-success" href="{{ route('customers.index')}}">Back</a>
            <button type="submit" class="btn btn-xs btn-primary" name="button">Submit</button>
        </div>
    </form>
        
    </div>
</div>

       
@endsection