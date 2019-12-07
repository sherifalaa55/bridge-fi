@extends('layout.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"><a href="{{route('orders.index')}}">Orders</a></h1>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Customer Address</th>
            <th>Creation Date</th>
            <th>Total Amount</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{$order->unique_id}}</td>
            <td>{{$order->user_name}}</td>
            <td>{{$order->user_phone}}</td>
            <td>{{$order->user_address}}</td>
            <td>{{date("Y-m-d h:i a", strtotime($order->order_date))}}</td>
            <td>{{$order->getTotal()}}</td>
            <td>
              <a href="{{route('orders.details', $order->id)}}" class="btn btn-primary m-1">View</a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Are you sure you want to delete this user.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          {{csrf_field()}}
          {{ method_field('DELETE') }}
          <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script type="text/javascript">
var baseUrl = "{{URL::to('orders')}}";
function deleteUser(id) {
  $("#deleteForm").attr('action', baseUrl + "/" + id);
}
</script>
@endsection