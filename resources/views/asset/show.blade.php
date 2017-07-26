@extends('layouts.asset')
@section('title')
	{{$item->item_type}} | {{$item->item_model}}
@stop

@section('content')
<div class="content-page">
		<!-- Start content -->
		<div class="content">
				<div class="container">

						<!-- Page-Title -->
						<div class="row">
								<div class="col-sm-12">
										<div class="btn-group pull-right m-t-15">
												<!--<button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
												<ul class="dropdown-menu drop-menu-right" role="menu">
													 <li><a href="view_request.php">View Request</a></li>
																		<li><a href="#">Manage Request</a></li>
																		<li><a href="#">View Staff</a></li>
																	<!--  <li class="divider"></li>
																		<li><a href="#">View Transaction</a></li>-->
												<!--</ul>-->
										</div>

										<h4 class="page-title">{{$item->item}} | <span>{{$item->asset_number}}</span></h4>
										<ol class="breadcrumb">
										</ol>
								</div>
						</div>

						<div class="row">
<div class="clearfix"></div>
		<div class="col-sm-4">

		<center>
		{!!Form::open([
			'method' => 'delete',
			'route' => ['items.destroy', $item->id]
		])!!}
			<img class="img-thumbnail img-responsive" width="400px" height="400px" style="margin-bottom: 10px;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate("AssetNo: $item->asset_number, Item: $item->item, Date Added: $item->created_at, Economic Life: $item->economiclife, Cost: $item->amount")) !!} ">

			 <p align="center"> @if ($item->asset_approval == 'PENDING')
				 <table cellspacing="10" border="1">
				 <tr><td><form class="form-horizontal" role="form" method="POST" action="{{ route('asset.assetdecision', $item->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="APPROVED" name="asset_approval">
           <input type="submit" value="APPROVE" name="APPROVE" class="btn btn-default"></form></td><td>&nbsp;&nbsp;</td>
           <td><form class="form-horizontal" role="form" method="POST" action="{{ route('asset.assetdecision', $item->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="DECLINED" name="asset_approval" ><input type="submit" value="DECLINE" name="DECLINE" class="btn btn-default"></form></td></tr>
				 </table>
				  @else  {!!Form::submit('Delete')!!} @endif
			 	{!!Form::close()!!}</p>
				</center>
		</div>
				<div class="col-sm-8">
				<div class="card-box table-responsive">
						<table class="table table-striped table-bordered">
							<tr><td>Asset Number</td><td class="whitebox" ><span>{{ $item->asset_number}}</span></td></tr>
							<tr><td>Serial Number</td><td class="whitebox" ><span>{{ $item->serialno}}</span></td></tr>
							<tr><td>Item</td><td class="whitebox" ><span>{{ $item->item }}</span></td></tr>
							<tr><td>Description</td><td class="whitebox" ><span>{{ $item->description }}</span></td></tr>
							<tr><td>Department</td><td class="whitebox" ><span>{{ $item->department }}</span></td></tr>
							<tr><td>Location</td><td class="whitebox" ><span>{{ $item->location }}</span></td></tr>
							<tr><td>Classification</td><td class="whitebox" ><span>{{ $item->classification }}</span></td></tr>
							<tr><td>Supplier</td><td class="whitebox" ><span>{{ $item->supplier_details }}</span></td></tr>
							<tr><td>Invoice Number</td><td class="whitebox" ><span>{{ $item->invoice_number }}</span></td></tr>
							<tr><td>Amount (&#8358)</td><td class="whitebox" ><span>{{ $item->amount }}</span></td></tr>
							<tr><td>Economic Life</td><td class="whitebox" ><span>{{ $item->economiclife }}</span></td></tr>
							<tr><td>Current Value</td><td class="whitebox" ><span>{{ $item->current_value }}</span></td></tr>
							<tr><td>Residual Value</td><td class="whitebox" ><span>{{ $item->residual_value }}</span></td></tr>
							@if (!empty($item->rate))
								 <tr><td>Rate</td><td class="whitebox" ><span>{{ $item->rate }}%</span></td></tr>
							@endif
							<tr><td>Depreciable?</td><td class="whitebox" ><span>{{ $item->isdepreciate }}</span></td></tr>
							@if ($item->isdepreciate == 'Yes')
						    <tr><td>Depreciation Formula</td><td class="whitebox" ><span>{{ $item->depreciationformula }}</span></td></tr>
						    @endif
						    <tr><td>Registered by</td><td class="whitebox" ><span>{{ $item->created_by }}</span></td></tr>
						    <tr><td>Purchase Date</td><td class="whitebox" ><span>{{ $item->purchase_date }}</span></td></tr>
							<tr><td>Date Added</td><td class="whitebox" ><span>{{ $item->created_at }}</span></td></tr>
							<tr><td>Last Updated</td><td class="whitebox" ><span>{{ $item->updated_at }}</span></td></tr>
						</table>

				</div>
		</div>
</div>
					</div>
				</div>
			</div>
@stop
