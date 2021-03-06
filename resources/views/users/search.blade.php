 @extends('layouts.staff')
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
				<h4 class="page-title">All Registered Users</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
    <caption>All Staff</caption>
        @if (empty($ords))
                <p>There are no matches</p>
        @else
			<tr><th>Staff ID &nbsp;</th><th>&nbsp;Name&nbsp;</th><th>&nbsp;Role&nbsp;</th><th>&nbsp;Department</th></tr>
	@foreach($ords as $user)

			<tr onclick="document.location='{{route('users.show', $user->id)}}'" style="cursor:hand"><td>{{$user->staffid}}</td><td>&nbsp;{{$user->name}}&nbsp;</td><td>&nbsp;<span>{{$user->role_id}}</span>&nbsp;</td><td>&nbsp;{{$user->department}}&nbsp;</td></tr>

	@endforeach
        @endif
	</table>
</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
