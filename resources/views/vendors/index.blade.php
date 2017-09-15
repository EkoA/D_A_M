@extends('layouts.vendors')
@section('title')
	View Vendors
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
				<h4 class="page-title">All Registered Vendors</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">

					@if (empty($vendors))
						<p>There are no registered vendors yet</p>
					@else
							<thead>
							<tr><th>&nbsp;Vendor Name&nbsp;</th><th>&nbsp;Product/Service&nbsp;</th><th>&nbsp;Date Registered</th></tr>
							</thead>
					@foreach($vendors as $vendor)

							<tr onclick="document.location='{{route('vendors.show',$vendor->id)}}'" style="cursor:hand;"><td>&nbsp;{{$vendor->vendor_name}}&nbsp;</td><td>&nbsp;{{$vendor->product_service}}&nbsp;</td><td>&nbsp;{{$vendor->created_at}}</a></td></tr>

					@endforeach
					@endif
					</table>

					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<!--<a href="{{route('items.create')}}">Add New Item</a>-->
@stop
