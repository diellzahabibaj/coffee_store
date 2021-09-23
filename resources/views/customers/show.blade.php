@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
    <h4>Show Customer</h4> <a class="btn btn-xs btn-primary" href="{{ route('customers.index')}}">Show all</a>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>First Name: </strong>
                {{ $customer->first_name}}
            </div>
        </div>
       
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Last Name: </strong>
                    {{ $customer->last_name}}
                </div>
            </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <strong>Gender: </strong>
                        {{ $customer->gender}}
                    </div>
                 </div>
                 <div class="col-xs-12">
                    <div class="form-group">
                        <strong>Phone number:</strong>
                        {{ $customer->phone_number}}
                    </div>
                 </div>

     </div>
    
@endsection