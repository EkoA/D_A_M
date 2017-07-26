@extends('layouts.departments')
@section('title')

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
				<h4 class="page-title">Request ID: <span>{{ $order->id }}</span></h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	{!!Form::open([	])!!}
	<tr><td>Item </td><td class="whitebox" ><span>{{ $order->order_item}}</span></td></tr>
	<tr><td>Description </td><td class="whitebox" ><span>{{ $order->description }}</span></td></tr>
	<tr><td>Department </td><td class="whitebox" ><span>{{ $order->department}}</span></td></tr>
	<tr><td>Requested By </td><td class="whitebox" ><span>{{$order->made_by}}</span></td></tr>
	<tr><td>Quantity </td><td class="whitebox" ><span>{{$order->quantity}}</span></td></tr>
	<tr><td>Cost(per Item)</td><td class="whitebox" ><span>{{$order->cost}}</span></td></tr>
	<tr><td>Total Cost </td><td class="whitebox" ><span>{{$order->quantity * $order->cost}}</span></td></tr>
	@if(!empty($order->comment))
	<tr><td>Comment </td><td class="whitebox" ><span>{{$order->comment}}</span></td></tr>
	@endif
	<tr><td>Finance Approval </td><td class="whitebox" ><span>{{ $order->finance_approval }}</span></td></tr>
	<tr><td>Unit Head Approval </td><td class="whitebox" ><span>{{ $order->hod_approval }}</span></td></tr>
	<tr><td>MD's Approval </td><td class="whitebox" ><span>{{ $order->admin_approval }}</span></td></tr>
	<tr><td>Date Added </td><td class="whitebox" ><span>{{ $order->created_at }}</span></td></tr>
	</table>
	{!!Form::close()!!}
	@if ($order->hod_approval != "PENDING" && $order->admin_approval != "APPROVED")
		<p></p>
	@else
	<table>

		<tr><td><form class="form-horizontal" role="form" method="POST" action="{{ route('orders.orderdecision', $order->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="APPROVED" name="request_approval">
			<input type="submit" value="APPROVE" name="APPROVE" class="btn btn-default"></form></td><td>&nbsp; &nbsp;</td>
			<td><form class="form-horizontal" role="form" method="POST" action="{{ route('orders.orderdecision', $order->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="DECLINED" name="request_approval"><input type="submit" value="DECLINE" name="DECLINE" class="btn btn-default"></form></td></tr>
</table>
	@endif

</table>
</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
