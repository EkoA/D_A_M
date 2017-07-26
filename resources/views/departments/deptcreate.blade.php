@extends('layouts.staff')
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
				<h4 class="page-title">All Registered Assets</h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover"">
                    <center>
                    <?php
                        //$ret = $_GET["ret"];
                        if(isset($_GET["res"]))
                        {
                            $res = $_GET["res"];
                        }

                    ?>

                    @if(isset($_GET["res"]))

                        <div class="">
                            <h4><span><?php echo $res; ?></span></h4>
                        </div>
                    @endif
                    </center>
                        <caption>All Departments</caption>
                            @if (empty($departments))
                                    <p>There are no users departments yet</p>
                            @else
                        <thead>
                    			<tr><th>Department &nbsp;</th><th>&nbsp;Short Code&nbsp;</th></tr>
                        </thead>
                    	@foreach($departments as $department)
                    			<tr><td>{{$department->dept_name}}</td><td>{{$department->short_code}}&nbsp;&nbsp;</td><td><form class="form-horizontal" role="form" method="POST" action="{{ route('departments.destroy', $department->id) }}">{{ csrf_field() }}{{ method_field('DELETE') }}<input type="submit" value="Delete" name="Delete"></form></td></tr>
                    	@endforeach
                            @endif
                    	</table>
                    </div>
                  </center>
                  <br>
                  <br>
</table>
</div>
</div>
<div class="col-sm-2"></div>
</div>

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
                    <h4 class="page-title">Add Department</h4>
                    <ol class="breadcrumb">

                    </ol>
                  </div>
                </div>

    <div class="card-box">
      <h5 class="m-t-0 header-title"><b>Add a New Department</b></h5>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('departments.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('dept_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Department</label>

                            <div class="col-md-10">
                                <input id="dept_name" type="text" class="form-control" name="dept_name" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order_item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Short Code</label>
                            <div class="col-md-10">
                                <input id="short_code" type="text" class="form-control" name="short_code" maxlength="2" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input id="created_by" type="hidden" class="form-control" name="created_by" value="{{$user->name}}" required>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                  </div>
                  <div class="col-sm-2"></div>
                  </div>
@endsection
