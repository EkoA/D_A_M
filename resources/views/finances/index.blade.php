@extends('layouts.finances')
@section('title')
	Dashboard
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
										<p class="text-muted page-title-alt">Welcome to the Finance panel</p>
								</div>
						</div>

<div class="row">
		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box fadeInDown animated" onclick="document.location='{{route('finances.pending')}}'" style="cursor:hand">
						<div class="bg-icon bg-icon-primary pull-left">
								<i class="md md-attach-file text-primary"></i>
						</div>
						<div class="text-right" >
							@foreach($corders as $orde)
								<h3 class="text-dark"><b class="counter">{{$orde->order_count}}</b></h3>
						  @endforeach
								<p class="text-muted">Pending Requests</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>

		<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box" onclick="document.location='{{route('items.index')}}'" style="cursor:hand">
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
				<div class="widget-bg-color-icon card-box">
						<div class="bg-icon bg-icon-info pull-left">
								<i class="md md-equalizer text-info"></i>
						</div>
						<div class="text-right">
								<h3 class="text-dark"><b class="counter">{{$cost}}</b></h3>
								<p class="text-muted">Total Asset Cost</p>
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
								<h3 class="text-dark"><b class="counter">{{$val}}</b></h3>
								<p class="text-muted">Asset Evaluation</p>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>
</div>

<div class="row">
		<div class="col-sm-12">
				<h4 class="page-title">Total Asset cost based on Departments</h4>
				<ol class="breadcrumb">
				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
						Total asset cost based on Departments
					<hr>
						<?php $tamount = 0; ?>
					    @if (empty($depart))
					        <p>There are no results</p>
					    @else
										<thead>
					            <tr><th>&nbsp;Department&nbsp;</th><th>&nbsp;Total Cost&nbsp;</th></tr>
										</thead>
							<?php
									//$tamount = $dep + $tamount;
							?>
											@for($i = 0; $i < count($department); $i++)
												<tr onclick="document.location='{{route('items.department',$department[$i]->id)}}'" style="cursor:hand;" >
													<td>{{$department[$i]->dept_name}}</td>
													<td>&#8358; {{ number_format($depart[$i])}}</td>
												</tr>
											@endfor
							@endif

						</table>
				</div>
</div>

<div class="row">
		<div class="col-sm-12">
				<h4 class="page-title">Pending Requests</h4>
				<ol class="breadcrumb">
						<li>
								<a href="{{route('finances.pending')}}">All Pending Requests</a>
						</li>
				</ol>
		</div>
</div>

<div class="card-box table-responsive">
<table id="datatable" class="table table-hover">
	@if (empty($orders))
		<center><p>There are no pending requests</p></center>
	@else
	<thead>
			<tr><th>Request ID &nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Status</th></tr>
	</thead>
	@foreach($orders as $order)

			<tr onclick="document.location='{{route('finances.show', $order->id)}}'" style="cursor:hand"><td>{{$order->id}}</td><td>{{$order->order_item}}&nbsp;</td><td>&nbsp;{{$order->finance_approval}}&nbsp;</td></tr>

	@endforeach
	@endif
</table>

</div>
</div>
<div class="col-sm-2"></div>
</div>
</div>
@stop
