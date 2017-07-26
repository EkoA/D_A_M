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
				<h4 class="page-title">Assets Pending Approval</h4>
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
			<p>There are no pending assets</p>
		@else
		<thead>
				<tr><th>&nbsp;Item Type&nbsp;</th><th>&nbsp;Cost</th><th>&nbsp;Purchase Date</th></tr>
		</thead>
		@foreach($items as $item)
				<tr onclick="document.location='{{route('asset.show',$item->id)}}'" style="cursor:hand"><td>&nbsp;{{$item->item}}&nbsp;</td><td>&nbsp;{{$item->amount}}</a></td><td>&nbsp;{{$item->purchase_date}}</a></td><td><form class="form-horizontal" role="form" method="POST" action="{{ route('asset.assetdecision', $item->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}
					<input type="hidden" value="APPROVED" name="asset_approval">
          <input type="submit" value="APPROVE" name="APPROVE"></form></td>
          <td><form class="form-horizontal" role="form" method="POST" action="{{ route('asset.assetdecision', $item->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}
					<input type="hidden" value="DECLINED" name="asset_approval">
					<input type="submit" value="DECLINE" name="DECLINE"></form></td>
        </tr>
		@endforeach
		@endif
		</table>

	</div>
</div>
<div class="col-sm-2"></div>
</div>
			<!--<a href="{{route('items.create')}}">Add New Item</a>-->
</center>
@stop
