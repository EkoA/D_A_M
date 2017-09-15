@extends('layouts.basic')
@section('title')
	Request new Item
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
                    <h4 class="page-title">Request Item</h4>
                    <ol class="breadcrumb">

                    </ol>
                  </div>
                </div>

<div class="row">
<div class="col-sm-12">
    <div class="card-box">
      <h5 class="m-t-0 header-title"><b>Request For an Item</b></h5>
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


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('orders.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Item</label>

                            <div class="col-md-10">
                                <input id="order_item" type="text" class="form-control" name="order_item" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order_item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">Description</label>

                            <div class="col-md-10">
                                <textarea id="email" type="description" class="form-control" name="description" value="{{ old('email') }}" required></textarea>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-2 control-label">Quantity</label>

                          <div class="col-md-10">
                                <input id="quantity" type="number" class="form-control" name="quantity"  value="1" min="1" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

												<div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
														<label for="cost" class="col-md-2 control-label">Cost (per Item)</label>

													<div class="col-md-10">
																<input id="cost" type="number" class="form-control" name="cost" step="any" value="1" min="1" required>

																@if ($errors->has('cost'))
																		<span class="help-block">
																				<strong>{{ $errors->first('cost') }}</strong>
																		</span>
																@endif
														</div>

												</div>

                            <input id="admin_approval" type="hidden" class="form-control" name="admin_approval" value="PENDING" required>
                            <input id="finance_approval" type="hidden" class="form-control" name="finance_approval" value="PENDING" required>
                            <input id="hod_approval" type="hidden" class="form-control" name="hod_approval" value="PENDING" required>
                            <input id="department" type="hidden" class="form-control" name="department" value="{{$user->department}}" required>
                            <input id="made_by" type="hidden" class="form-control" name="made_by" value="{{$user->name}}" required>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-user"></i> Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
