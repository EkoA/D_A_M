
@extends('layouts.items')
@section('title')
	All Asset Classifications
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
				<h4 class="page-title">Assets Classes</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
<table id="datatable" class="table table-hover"">
	@if (empty($classifications))
		<p>There are no registered assets yet</p>
	@else
		<thead>
			<tr><th>&nbsp;Short Code&nbsp;</th><th>&nbsp;Classification&nbsp;</th><th>&nbsp;Description&nbsp;</th></tr>
		</thead>
	@foreach($classifications as $classification)
			<tr onclick="document.location='{{route('classifications.show', $classification->id)}}'" style="cursor:hand"><td>&nbsp;{{$classification->short_code}}&nbsp;</td><td>&nbsp;{{$classification->class_name}}&nbsp;</td><td>&nbsp;{{$classification->description}}&nbsp;</td><td><form class="form-horizontal" role="form" method="POST" action="{{ route('classifications.destroy', $classification->id) }}">{{ csrf_field() }}{{ method_field('DELETE') }}<input type="submit" value="Delete" name="Delete"></form></td></tr>

	@endforeach
	@endif
	</table>

	<form class="form-horizontal" role="form" action="{{route('classifications.create')}}">
		{{ csrf_field() }}
		<input class="btn btn-default" type="submit" name="Add New Class" value="Add New Class">
	</form>

</div>
</div>
<div class="col-sm-2"></div>
</div>
			<!--<a href="{{route('items.create')}}">Add New Item</a>-->
@stop
