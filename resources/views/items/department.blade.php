@extends('layouts.items')
@section('title')
	All Items
@stop

@section('body')
<div class="content-page">
		<!-- Start content -->
		<div class="content">
				<div class="container">

<div class="row">
		<div class="col-sm-12">
				<h4 class="page-title">All Registered Assets in {{$dept->dept_name}}</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">

					@if(empty($items))
						<p>There are no registered assets for this {{$dept->dept_name}} yet</p>
					@else
							<thead>
							<tr><th>&nbsp;Asset Number&nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Amount</th></tr>
							</thead>
					@foreach($items as $item)

							<tr onclick="document.location='{{route('items.show',$item->id)}}'" style="cursor:hand;"><td>&nbsp;{{$item->asset_number}}&nbsp;</td><td>&nbsp;{{$item->item}}&nbsp;</td><td>&nbsp;{{$item->amount}}</a></td></tr>

					@endforeach
					@endif
					</table>

					<form class="form-horizontal" role="form" method="POST" action="{{ route('items.generateReport') }}">
						{{ csrf_field() }}
						<input type="hidden" name="report_details" value="{{$items}}">
						<input type="hidden" name="report_type" value="general">
						<input class="btn btn-default" type="submit" name="Generate Report" value="Generate Report">
					</form>

					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<!--<a href="{{route('items.create')}}">Add New Item</a>-->
@stop
