@extends('layouts.appadmin')

<?php
//code that refereshes the page every 30 seconds
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 30; URL=$url1");
?>

@section('content')
<div class="content-page">
		<!-- Start content -->
		<div class="content">
				<div class="container">

						<!-- Page-Title -->
						<div class="row">
								<div class="col-sm-12">
										<!--<div class="btn-group pull-right m-t-15">
												<button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
												<ul class="dropdown-menu drop-menu-right" role="menu">
														<li><a href="#">View Request</a></li>
														<li><a href="#">Manage Request</a></li>
														<li><a href="#">View Staff</a></li>
														<li class="divider"></li>
														<li><a href="#">View Transaction</a></li>
												</ul>
										</div>-->
										<h4 class="page-title">Dashboard</h4>
										<p class="text-muted page-title-alt">Welcome to the Admin panel</p>
								</div>
						</div>

<div class="row">
		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box fadeInDown animated" onclick="document.location='{{route('orders.pending')}}'" style="cursor:hand">
						<div class="bg-icon bg-icon-primary pull-left">
								<i class="md md-attach-file text-primary"></i>
						</div>
						<div class="text-right" >
							@foreach($orders as $orde)
								<h3 class="text-dark"><b class="counter">{{$orde->order_count}}</b></h3>
						  @endforeach
								<p class="text-muted">Pending Requests</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>

		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box" onclick="document.location='{{route('asset.index')}}'" style="cursor:hand">
						<div class="bg-icon bg-icon-pink pull-left">
								<i class="md md-add-shopping-cart text-pink"></i>
						</div>
						<div class="text-right" >
							@foreach($items as $ite)
								<h3 class="text-dark"><b class="counter">{{$ite->item_count}}</b></h3>
							@endforeach
								<p class="text-muted">Registered Assets</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>

		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box" onclick="document.location='{{route('users.index')}}'" style="cursor:hand">
						<div class="bg-icon bg-icon-info pull-left">
								<i class="md md-equalizer text-info"></i>
						</div>
						<div class="text-right">
              @foreach($uzer as $uset)
								<h3 class="text-dark"><b class="counter">{{$uset->user_count}}</b></h3>
              @endforeach
								<p class="text-muted">Total No of Users</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>

		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
						<div class="bg-icon bg-icon-success pull-left">
								<i class="md md-remove-red-eye text-success"></i>
						</div>
						<div class="text-right">
								<h3 class="text-dark"><b class="counter">{{$cost}}</b></h3>
								<p class="text-muted">Total Cost of Assets</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>
</div>

<div class="row">
		<div class="col-sm-12">
				<h4 class="page-title">Pending Requests</h4>
				<ol class="breadcrumb">
						<li>
								<a href="{{route('orders.pending')}}">All Pending Requests</a>
						</li>
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
<tr><th>Request ID &nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Made By&nbsp;</th><th>&nbsp;Quantity&nbsp;</th><th>&nbsp;Description</th></tr>
</thead>
@foreach($torders as $order)
<tr onclick="document.location='{{route('orders.show', $order->id)}}'" style="cursor:hand"><td>{{$order->id}}</td><td>{{$order->order_item}}&nbsp;</td><td style="color:<?php //echo $acol; ?>;">&nbsp;{{$order->made_by}}&nbsp;</td><td style="color:<?php //echo $fcol; ?>;" >&nbsp;{{$order->quantity}}&nbsp;&nbsp;</td><td>&nbsp;{{$order->description}}&nbsp;</td></tr>
@endforeach
@endif
</table>
</div>
</div>
</div>
</div>

@endsection
