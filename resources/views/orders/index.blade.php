@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-lg-12">
      
        <h3> Orders</h3>
    </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
      <div class="pull-right">
      <a class="btn btn-xs btn-success" href="{{ route('orders.create') }}"> Add new Order</a>
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
        <th>Customer</th>
        <th>Order Time</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Total</th>
        
      </tr>

      @foreach($orders as $order)
      <tr data-entry-id="{{ $order->id }}">
          <td>
              {{ $order->id  }}
          </td>
          <td>
              {{ $order->customer->first_name }}
          </td>
          <td>
              {{ $order->order_time }}
          </td>
          
          <td>
              <ul>
              @foreach($order->products as $product)
                  <li>{{ $product->name }}</li>
              @endforeach
              </ul>
          </td>
          <td>
            <ul>
            @foreach($order->products as $product)
                <li>{{ $product->price }}</li>
            @endforeach
            </ul>
        </td>
        <td>
          <ul>
            @foreach($order->products as $product)
            <li>{{ $product->pivot->quantity }}</li>
        @endforeach
          </ul>
      </td>
      <td>
        <ul>
          @foreach($order->products as $product)
          <li>{{ $product->pivot->amount }}</li>
      @endforeach
        </ul>
    </td>
      <td>
        <ul>
          
       <li>{{ $total=$product->price*$product->pivot->quantity}} </li>
       
        </ul>
      </td>
      <td>
        <a class="btn btn-xs btn-info" href="{{route('orders.show', $order->id)}}">Show</a>

        
        <form action="{{route('orders.destroy', $order->id )}}" method="post" class="d-inline">
          
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-xs btn-danger" name="button">Delete</button>
      
          
      </form>
      </td>
    </tr>
  @endforeach
</table>

  


    



@endsection