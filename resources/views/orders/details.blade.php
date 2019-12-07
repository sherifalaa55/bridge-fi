@extends('layout.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"><a href="{{route('orders.index')}}">Orders</a> > #{{$order->unique_id}}</h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
  	<h4>Outputs</h4>
  </div>
  <div class="card-body">
  		<div class="row">
  			<div class="col-md-3">
  				<p>Customer Name</p>
  				<h3>{{$order->user_name}}</h3>
  			</div>
  			<div class="col-md-3">
  				<p>Customer Phone</p>
  				<h3>{{$order->user_phone}}</h3>
  			</div>
  			<div class="col-md-3">
  				<p>Customer Address</p>
  				<h3>{{$order->user_address}}</h3>
  			</div>
  			<div class="col-md-3">
  				<p>Creation Date</p>
  				<h3>{{date("Y-m-d h:i a", strtotime($order->order_date))}}</h3>
  			</div>

  		</div>
  </div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
	  	<h4>Outputs</h4>
	</div>
	<div class="card-body">
  		<div class="row">
  			<div class="table-responsive">
		      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		        <thead>
		          <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Price</th>
		            <th>Quantity</th>
		            <th>Total</th>
		          </tr>
		        </thead>
		        <tbody>
		          @foreach($order->items as $item)
		          <tr>
		            <td>{{$item->product_id}}</td>
		            <td>{{$item->product->name}}</td>
		            <td>{{$item->price}}</td>
		            <td>{{$item->quantity}}</td>
		            <td>{{$item->quantity * $item->price}}</td>
		          </tr>
		         @endforeach
		         <tr>
		         	<td colspan="3"></td>
		         	<td>Total:</td>
		         	<td>{{$order->getTotal()}}</td>
		         </tr>
		        </tbody>
		      </table>
		    </div>

  		</div>
  </div>
<div>

@endsection

