@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-lg-12">
      
        <h3> Customers</h3>
    </div>
    </div>
  
   <div class="row">
    <div class="col-sm-12">
    <div class="pull-right">
    <a class="btn btn-xs btn-success" href="{{ route('customers.create') }}"> Add new Customer</a>
    </div>
  </div>
  </div>
   

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{$message}}</p>
    </div>
    @endif

    <table class="table table-bordered ">
      <tr>
        <th>No.</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Phone number</th>
      </tr>

      @foreach ($customers as $customer)
        <tr>
          <td>{{$customer->id }}</td>
          <td>{{$customer->first_name}}</td>
          <td>{{$customer->last_name}}</td>
          <td>{{$customer->gender}}</td>
          <td>{{$customer->phone_number}}</td>
          <td>
            <a class="btn btn-xs btn-info" href="{{route('customers.show', $customer->id)}}">Show</a>

            <form action="{{route('customers.destroy', $customer->id )}}" method="post" class="d-inline">
              
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-xs btn-danger" name="button">Delete</button>
            
                
            </form>

           
          </td>
        </tr>
      @endforeach
    </table>



@endsection