@extends('layouts.staff')
@section('title')
    Change Password - {{$user->id}}
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
                                            <li><a href="#">View Staff</a></li>
                                          <!--  <li class="divider"></li>
                                            <li><a href="#">View Transaction</a></li>-->
                                <!--</ul>
                                </div>-->
                    <h4 class="page-title">Edit User</h4>
                    <ol class="breadcrumb">

                    </ol>
                  </div>
                </div>

<div class="row">
<div class="col-sm-12">
    <div class="card-box">
      <h5 class="m-t-0 header-title"><b>Edit User | <span>{{$user->staffid}}</span></b></h5>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('users.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('staffid') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Staff ID</label>

                            <div class="col-md-10">
                                <input id="staffid" type="text" class="form-control" name="staffid" value="{{$user->staffid}}" required>

                                @if ($errors->has('staffid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('staffid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">E-Mail Address</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


						<?php

						$role = $user->role_id;

						echo "<center><p>Current Role: <span>" . $role."</span></p></center>";
						?>

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-2 control-label">Role:</label>
                            <div class="col-md-10">
                            <span>
                                 <select name ="role_id" id="role_id" class="form-control">
                                  <option value="ADMIN">ADMIN</option>
                                  <option value="HOF">HEAD OF FINANCE</option>
                                  <option value="HOD">H.O.D</option>
                                  <option value="BASIC">BASIC</option>
                                </select>
                            </span>
                            </div>
                        </div>

						<?php

						$dept = $user->department;

						echo "<center><p>Current Department: <span>" . $dept."</span></p></center>";
						?>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <center><label for="department" class="col-md-2 control-label">Department</label></center>
                            <div class="col-md-10">
                              <span>
                                  <select name ="department" id="department" class="form-control">
                                     @if (empty($departments))
                                     <option value="None">There are no departments yet</option>
                                     @else
                                     @foreach($departments as $department)
                                     <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                                     @endforeach
                                     @endif
                                 </select>
                              </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-user"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>

            <!--<a href="{{route('orders.create')}}">Add New order</a>-->
          </div>
          </div>
          <div class="col-sm-2"></div>
          </div>
@endsection
