@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-lg-12">
      
        <h3> Products</h3>
    </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
      <div class="pull-right">
      <a class="btn btn-xs btn-success" href="{{ route('products.create') }}"> Add new Product</a>
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
        <th>Name</th>
        <th>Price</th>
        <th>Coffee Origin</th>
      </tr>

      @foreach ($products as $product)
        <tr>
          <td>{{$product->id }}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->coffee_origin}}</td>
          <td>
            <a class="btn btn-xs btn-info" href="{{route('products.show', $product->id)}}">Show</a>

            
            <form action="{{route('customers.destroy', $product->id )}}" method="post" class="d-inline">
              
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-xs btn-danger" name="button">Delete</button>
          
              
          </form>
          </td>
        </tr>
      @endforeach
    </table>



@endsection