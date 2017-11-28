@extends('layouts.finances')
@section('title')
	Add new Item
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
												<h4 class="page-title">Report Generation</h4>
												<ol class="breadcrumb">
                          <?php
                          if(!empty($msg))
                          {
                            echo "<center><p style='color:red;'> $msg </p></center>";
                          }
                          ?>
												</ol>
											</div>
										</div>

<div class="row">
		<div class="col-sm-12">
				<div class="card-box">
					<h5 class="m-t-0 header-title"><b>Report Generation for requests</b></h5>

					<center>
					<?php
							//$ret = $_GET["ret"];
							if(isset($_GET["ret"]))
							{
									$ret = $_GET["ret"];
							}
							//echo $ret;
					?>

					@if(isset($_GET["ret"]))
							<span><?php echo $ret;?>
					@endif
					</center>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('orders.reportgen') }}">
                        {{ csrf_field() }}


                         <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-10">
                            <span>
																<select name ="department" id="department" class="form-control">
                                  <option value="None" selected="selected">All</option>
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

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-2 control-label">Amount (Range)</label>

                            <div class="col-md-4">
                                <p>From: <input id="amount" type="number" class="form-control" name="amount_from" step="any" placeholder="Amount range(From)" min="1"  ></p>
                                <p>To: <input id="amount" type="number" class="form-control" name="amount_to" step="any" placeholder="Amount range(To)" min="1"  ></p>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                            <label for="purchase_date" class="col-md-2 control-label">Date</label>
                            <?php
                                $dat = date("Y-m-d");
                            ?>
                            <div class="col-md-4">
                                <p>From: <input id="purchase_date" type="date" class="form-control" name="purchase_date_from" placeholder="Date of purchase" max="<?php echo $dat; ?>"  ></p>
                                <p>To: <input id="purchase_date" type="date" class="form-control" name="purchase_date_to" placeholder="Date of purchase" max="<?php echo $dat; ?>"  ></p>

                                @if ($errors->has('purchase_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('purchase_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus" ></i> Generate
                                </button>
                            </div>
                        </div>

                    </form>
				</div>
		</div>
</div>
</div>
</div>
</div>
@stop
