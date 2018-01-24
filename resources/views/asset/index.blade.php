@extends('layouts.asset')
@section('title')
	All Items
@stop

@section('content')
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
				<h4 class="page-title">All Registered Assets</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-striped table-bordered">

					@if (empty($items))
						<p>There are no registered assets yet</p>
					@else
							<thead>
							<tr><th>&nbsp;Asset Number&nbsp;</th><th>&nbsp;Item Type&nbsp;</th><th>&nbsp;Date Registered</th></tr>
							</thead>
					@foreach($items as $item)

							<tr onclick="document.location='{{route('asset.show',$item->id)}}'" style="cursor:hand"><td>&nbsp;{{$item->asset_number}}&nbsp;</td><td>&nbsp;{{$item->item}}&nbsp;</td><td>&nbsp;{{$item->created_at}}</a></td></tr>

					@endforeach
					@endif
					</table>
					<div class="text-center">{!! $items->links(); !!}</div>

					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
@stop
