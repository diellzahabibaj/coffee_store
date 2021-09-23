@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
          <h3>Add New Order</h3>
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


<form action="{{route('orders.store')}}" method="post">
  @csrf

  

  <div class="card">
      <div class="card-header">
          Products
      </div>

      <div class="card-body">
          <table class="table" id="products_table">
              <thead>
                  <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>-</th>
                      <th>Amount</th>

                  </tr>
              </thead>
              <tbody>
                  <tr id="product0">
                      <td>
                          <select name="products[]" class="form-control">
                              <option value="">-- choose product --</option>
                              
                              @foreach ($products as $product)
                                  <option value="{{ $product->id }}">
                                      {{ $product->name }}
                                  </option>
                              @endforeach
                          </select>
                      </td>
                      <td><input type="text" name='price[]' placeholder='Enter price' id="price" class="form-control price" step="0" min="0"/></td>
                          
                      
                        <td><input type="text" name='quantities[]' placeholder='Enter Qty' id="quantities" class="form-control quantities" step="0" min="0"/></td>
                           <td> <input type="button" value="-" class="minus" id="minus"></td>
                        <td><input type="text" name='amount[]' placeholder='0.00' class="form-control amount" readonly/></td>
                  </tr>
                  <tr id="product1"></tr>
              </tbody>
              <tfoot>
                <tr>
                    
                    <th > Total</th>
                    <td class="text-center"><input type="number" name='total' placeholder='0.00' class="form-control" id="total"  readonly/></td>
                </tr>
            </tfoot>
          </table>
        <div class="row">
            <div class="col-md-12">
                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
            </div>
        </div> 
      </div>
  </div>
  <div class="row form-group">
    <div class="col-md-12">
        <label for="customer_id">Customer</label>
        <select name="customer_id" id="customer_id" class="form-control">
            <option value="">Select</option>
         
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->first_name }}</option>
                
                @endforeach
        </select>
    </div>
   </div>
 
<div class="row form-group">
    <div class="col-md-12">
        <label for="">Order time : </label>
        
        <input type="date" name="order_time" class="form-control">
       
    </div>
</div>  
  <div class="col-lg-12">
    <a class="btn btn-xs btn-success" href="{{ route('orders.index')}}">Back</a>
    <button type="submit" class="btn btn-xs btn-primary" name="button">Buy</button>
  </div>
</form>
 @endsection



@section('scripts')
<script>
   $(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
      }
      calc();
   
  });
  $('#products_table tbody').on('keyup change',function(){
		calc();
	});
	
   });
function calc()
{
	$('#products_table tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.quantities').val();
			var price = $(this).find('.price').val();
			$(this).find('.amount').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	amount=0;
	$('.amount').each(function() {
        amount += parseInt($(this).val());
    });
	$('#total').val(amount.toFixed(2));

}
    $('.minus').click(function(){
    if ($('#quantities').val() != 0)
        
        $('#quantities' ).val(parseInt($('#quantities').val()) - 1);
});
 
</script>

@endsection 

  