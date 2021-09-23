@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as an Admin!') }}
                    
                </div>
                <div class="card-body">
                    <div class="links">
                        <a href="/products">Products</a>
                              <a href="/customers">Customers</a>
                              <a href="/orders">Orders</a>
                     </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>

@endsection
