@extends('layouts.orders')
@section('title')
	{{$order->order_item}}
@stop

@section('body')
<div class="content-page">
		<!-- Start content -->
		<div class="content">
				<div class="container">

<div class="row">
		<div class="col-sm-12">
				<!--<div class="btn-group pull-right m-t-15">
						<button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
						<ul class="dropdown-menu drop-menu-right" role="menu">
							 <li><a href="view_request.php">View Request</a></li>
												<li><a href="#">Manage Request</a></li>
												<li><a href="#">View Staff</a></li>>
						</ul>
				</div>-->
				<h4 class="page-title">Request ID | <span>{{ $order->id }}</span></h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	<tr><td>Request ID: </td><td class="whitebox" ><span>{{ $order->id }}</span></td></tr>
	<tr><td>Item </td><td class="whitebox" ><span>{{ $order->order_item}}</span></td></tr>
	<tr><td>Description </td><td class="whitebox" ><span>{{ $order->description }}</span></td></tr>
	<tr><td>Department </td><td class="whitebox" ><span>{{ $order->department}}</span></td></tr>
	<tr><td>Requested By </td><td class="whitebox" ><span>{{$order->made_by}}</span></td></tr>
	<tr><td>Quantity </td><td class="whitebox" ><span>@if ($order->admin_approval == "PENDING")<input type="number" min="1" value="{{$order->quantity}}" name="quantity" id="quantity1" onkeyup="cchangeValue(this)"/>@else {{$order->quantity}} @endif</span></td></tr>
	<tr><td>Cost(per Item)</td><td class="whitebox" ><span>@if ($order->admin_approval == "PENDING")<input type="number" min="1" value="{{$order->cost}}" name="cost" id="cost1" onkeyup="changeValue(this)"/>@else {{$order->cost}} @endif</span></td></tr>
	<tr><td>Comment </td><td class="whitebox" ><span>@if ($order->admin_approval == "PENDING")<textarea name="comment" id="comm1" onkeyup="chhangeValue(this)"/> </textarea> @else {{$order->comment}} @endif</span></td></tr>
	<tr><td>Total Cost </td><td class="whitebox" ><span>{{$order->quantity * $order->cost}}</span></td></tr>
	<tr><td>MD's Approval </td><td class="whitebox" ><span>{{ $order->admin_approval }}</span></td></tr>
	<tr><td>Finance Approval </td><td class="whitebox" ><span>{{ $order->finance_approval }}</span></td></tr>
	<tr><td>Unit Head Approval </td><td class="whitebox" ><span>{{ $order->hod_approval }}</span></td></tr>
	<tr><td>Date Added </td><td class="whitebox" ><span>{{ $order->created_at }}</span></td></tr>
	@if ($order->admin_approval != "PENDING")
		<p></p>
	@else
	<center>
		<tr><td><form class="form-horizontal" role="form" method="POST" action="{{ route('orders.orderdecision', $order->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="APPROVED" name="request_approval"><input type="hidden" id="quantity2" value="{{$order->quantity}}" name="quantity">
			<input type="hidden" id="cost2" name="cost"  value="{{$order->quantity * $order->cost}}">
			<textarea name="comment" id="comm2" onkeyup="changeValue(this)" style="display:none;"/> </textarea>
			<input type="submit" value="APPROVE" name="APPROVE" class="btn btn-default"></form></td>
			<td><form class="form-horizontal" role="form" method="POST" action="{{ route('orders.orderdecision', $order->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="DECLINED" name="request_approval">
				<textarea name="comment" id="comm3" onkeyup="changeValue(this)" style="display:none;"/> </textarea>
				<input type="submit" value="DECLINE" name="DECLINE" class="btn btn-default"></form></td></tr>																	<!--change edit to decline -->
			<script type="text/javascript">
		function cchangeValue(o){
			 document.getElementById('quantity2').value=document.getElementById('quantity1').value;
			}

			function changeValue(o){
				 document.getElementById('cost2').value=document.getElementById('cost1').value;
				}

			function chhangeValue(o){
					document.getElementById('comm2').value=document.getElementById('comm1').value;
					document.getElementById('comm3').value=document.getElementById('comm1').value;
				}
		</script>
	</center>
	@endif
	</table>
	{!!Form::close()!!}

</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
