@extends('layouts.basic')
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
				<h4 class="page-title">Request | <span>{{ $order->id }}</span></h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	<tr><td>Request ID </td><td class="whitebox" ><span>{{ $order->id }}</span></td></tr>
	<tr><td>Requested Item </td><td class="whitebox" ><span>{{ $order->order_item }}</span></td></tr>
	<tr><td>Description </td><td class="whitebox" ><span>{{ $order->description}}</span></td></tr>
	<tr><td>Quantity </td><td class="whitebox" ><span>{{$order->quantity}}</span></td></tr>
	<tr><td>Cost(per Item)</td><td class="whitebox" ><span>{{$order->cost}}</span></td></tr>
	<tr><td>Total Cost </td><td class="whitebox" ><span>{{$order->quantity * $order->cost}}</span></td></tr>
	@if(!empty($order->comment))
	<tr><td>Comment </td><td class="whitebox" ><span>{{$order->comment}}</span></td></tr>
	@endif
	<tr><td>MD's Approval </td><td class="whitebox" ><span>{{ $order->admin_approval }}</span></td></tr>
	<tr><td>Finance Approval </td><td class="whitebox" ><span>{{ $order->finance_approval }}</span></td></tr>
	<tr><td>H.O.D Approval </td><td class="whitebox" ><span>{{ $order->hod_approval }}</span></td></tr>
	<tr><td>Date Requested </td><td class="whitebox" ><span>{{ $order->created_at }}</span></td></tr>
	</table>
</div>
	<button onclick="window.print()">Print this page</button>
</div>
<div class="col-sm-2"></div>
</div>
@stop
