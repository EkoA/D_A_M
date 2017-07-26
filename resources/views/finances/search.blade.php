 @extends('layouts.items')
@section('title')
	Search
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
				<h4 class="page-title">Search Result(s)</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	@if (empty($items))
		<p>There are no matches</p>
	@else
			<tr><th>&nbsp;Asset Number&nbsp;</th><th>&nbsp;Item Type&nbsp;</th><th>&nbsp;Date Registered</th></tr>

	@foreach($items as $item)
  <tr onclick="document.location='{{route('items.show', $item->id)}}'" style="cursor:hand"><td>&nbsp;{{$item->asset_number}}&nbsp;</td><td>&nbsp;{{$item->item}}&nbsp;</td><td>&nbsp;{{$item->created_at}}</a></td></tr>

	@endforeach

	</table>

  <form class="form-horizontal" role="form" method="POST" action="{{ route('items.generateReport') }}">
		{{ csrf_field() }}
		<input type="hidden" name="report_details" value="{{$items}}">
		<input type="hidden" name="report_type" value="search">
		<input class="btn btn-default" type="submit" name="Generate Report" value="Generate Report">
	</form>
@endif
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
@stop
