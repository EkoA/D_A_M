@extends('layouts.orders')
@section('title')
	All Pending Requests
@stop

<?php
//code that refereshes the page every 30 seconds
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 30; URL=$url1");
?>

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
				<h4 class="page-title">Pending Requests</h4>
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
							<center><p>There are no pending requests</p></center>
						@else
		<thead>
			<tr><th>Request ID &nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Admin&nbsp;</th><th>&nbsp;Finance&nbsp;</th><th>&nbsp;Unit Head</th></tr>
		</thead>
	@foreach($orders as $order)

			<?php

				$fstatus = "{$order->finance_approval}";
				if($fstatus == "PENDING")
				{
					$fcol = "yellow";
				}
				else if($fstatus == "DENIED")
				{
					$fcol = "red";
				}
				else if($fstatus == "APPROVED")
				{
					$fcol = "green";
				}


				$astatus = "{$order->admin_approval}";
				if($astatus == "PENDING")
				{
					$acol = "yellow";
				}
				else if($astatus == "DENIED")
				{
					$acol = "red";
				}
				else if($astatus == "APPROVED")
				{
					$acol = "green";
				}

				//echo $fstatus;

			?>
			<tr onclick="document.location='{{route('orders.show', $order->id)}}'" style="cursor:hand"><td>{{$order->id}}</td><td>{{$order->order_item}}&nbsp;</td><td style="color:<?php //echo $acol; ?>;">&nbsp;{{$order->admin_approval}}&nbsp;</td><td style="color:<?php //echo $fcol; ?>;" >&nbsp;{{$order->finance_approval}}&nbsp;&nbsp;</td><td>&nbsp;{{$order->hod_approval}}&nbsp;</td></tr>
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
