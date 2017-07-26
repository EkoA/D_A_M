@extends('layouts.departments')
@section('title')
	All Departments
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
				<h4 class="page-title">All Requests</h4>
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
		<p>There are no requests yet</p>
	@else
			<tr><th>Order ID &nbsp;</th><th> &nbsp;Item Ordered</th></tr>
	@foreach($orders as $order)

			<tr onclick="document.location='{{route('departments.show', $order->id)}}'" style="cursor:hand" ><td>{{$order->id}}</td><td>&nbsp;{{$order->order_item}}</td></tr>

	@endforeach
	@endif
	</table>
</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
