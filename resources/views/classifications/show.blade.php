@extends('layouts.items')
@section('title')
	{{$classification->class_name}}
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
				<h4 class="page-title">{{$classification->class_name}} | <span>{{$classification->short_code}}</span></h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
<table id="datatable" class="table table-hover">
{{$classification->class_name}} | <span>{{$classification->short_code}}</span>
<hr>
	<?php $tamount = 0; ?>
    @if (empty($classmembers))
        <p>There are no registered assets under this class</p>
    @else
					<thead>
            <tr><th>&nbsp;Asset Number&nbsp;</th><th>&nbsp;Item Type&nbsp;</th><th>&nbsp;Cost</th></tr>
					</thead>
    @foreach($classmembers as $classmember)
            <tr onclick="document.location='{{route('items.show',$classmember->id)}}'" style="cursor:hand"><td>&nbsp;{{$classmember->asset_number}}&nbsp;</td><td>&nbsp;{{$classmember->item}}&nbsp;</td><td>&nbsp;{{$classmember->amount}}&nbsp;</td></tr>
            <?php
                $tamount = $classmember->amount + $tamount;
            ?>
    @endforeach
		@endif
    <tr ><td></td><td>Total</td><td>&#8358; <?php echo number_format($tamount) ?></td></tr>
	</table>

	<form class="form-horizontal" role="form" method="POST" action="{{ route('classifications.generateReport') }}">
		{{ csrf_field() }}
		<input class="btn btn-default" type="submit" name="Generate Report" value="Generate Report">
	</form>

</div>
</div>
<div class="col-sm-2"></div>
</div>

@stop
