@extends('layouts.basic')
@section('title')
	All Sent Requests
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
				<h4 class="page-title">All Requests Made By You</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	@if (empty($orders))
	<center>
		<p>You haven't made any requests yet</p>
	</center>
	@else
	<thead>
			<tr><th>Request ID &nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Status&nbsp;</th>
	</thead>
	@foreach($orders as $order)
			<tr  onclick="document.location='{{route('basic.show', $order->id)}}'" style="cursor:hand"><td>{{$order->id}}</td><td>{{$order->order_item}}&nbsp;</td><td>&nbsp;{{$order->admin_approval}}&nbsp;</td></tr>
	@endforeach
	@endif
	</table>
<div class="text-center">{!! $orders->links(); !!}</div>
		<!--<a href="{{route('orders.create')}}">Add New order</a>-->
	</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
