<?php $layout = 'layouts.staff'; ?>
@if(Auth::check())
		@if(Auth::user()->role_id == 'HOD')
				<?php $layout = 'layouts.departments'; ?>
		@else
				<?php $layout = 'layouts.staff'; ?>
		@endif
@endif
@extends($layout)

@section('title')
	User ID | {{$user->id}}
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
				<h4 class="page-title">All Requests</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	{!!Form::open([
		'method' => 'delete',
		'route' => ['users.destroy', $user->id]
	])!!}
	<tr><td>Staff ID </td><td class="whitebox" ><span>{{ $user->staffid }}</span></td></tr>
	<tr><td>Name </td><td class="whitebox" ><span>{{ $user->name}}</span></td></tr>
	<tr><td>Email </td><td class="whitebox" ><span>{{ $user->email }}</span></td></tr>
	<tr><td>Role </td><td class="whitebox" ><span>{{ $user->role_id }}</span></td></tr>
	<tr><td>Department</td><td class="whitebox" ><span>{{ $user->department }}</span></td></tr>
	<tr><td>Date Added</td><td class="whitebox" ><span>{{ $user->created_at }}</span></td></tr>
	<tr><td>Last Modified</td><td class="whitebox" ><span>{{ $user->updated_at }}</span></td></tr>
	</table>
	<br>
	<center>
	<a href="{{route('users.activatemail', $user->id)}}">Resend activation</a>&nbsp; | <a href="{{route('users.edit', $user->id)}}">Edit</a>&nbsp; | &nbsp;{!!Form::submit('Delete')!!} &nbsp; | &nbsp; <a href="{{route('users.resetpassword', $user->id)}}">Reset Password</a>
	</center>
	{!!Form::close()!!}

</div>
</div>
<div class="col-sm-2"></div>
</div>

@stop
