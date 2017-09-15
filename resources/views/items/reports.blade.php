@extends('layouts.items')
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
					<h5 class="m-t-0 header-title"><b>Report Generation Registration Form</b></h5>

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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('items.reportgen') }}">
                        {{ csrf_field() }}

												<div class="form-group{{ $errors->has('economiclife') ? ' has-error' : '' }}">
														<label for="economiclife" class="col-md-2 control-label">Useful Economic Life</label>
														<div class="col-md-10">
																<input id="economiclife" type="number" class="form-control" placeholder="Useful Economic Life (Years)" name="economiclife" value="{{ old('economiclife') }}"  min="1" >

																@if ($errors->has('economiclife'))
																		<span class="help-block">
																				<strong>{{ $errors->first('economiclife') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group{{ $errors->has('residual_value') ? ' has-error' : '' }}">
														<label for="residual_value" class="col-md-2 control-label">Residual Value (Range)</label>
														<div class="col-md-4">
																<p>From: <input id="residual_value" type="number" class="form-control" placeholder="Residual Value range(From)" name="residual_value_from" value="{{ old('residual_value') }}"  min="1" ></p>
                                <p>To: <input id="residual_value" type="number" class="form-control" placeholder="Residual Value range(To)" name="residual_value_to" value="{{ old('residual_value') }}"  min="1" ></p>

																@if ($errors->has('residual_value'))
																		<span class="help-block">
																				<strong>{{ $errors->first('residual_value') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<!--<div class="form-group{{ $errors->has('depreciationformula') ? ' has-error' : '' }}">
														 <label for="depreciationformula" class="col-sm-2 control-label">Depreciation Formula</label>
														 <div class="col-sm-10">
															 <span id="subz">
																<select class="form-control" name ="depreciationformula" id="depreciationformula" onchange="rateChange()">
																																			<option value="STRAIGHT LINE METHOD">STRAIGHT LINE METHOD</option>
																																			<option value="REDUCING BALANCE METHOD">REDUCING BALANCE METHOD</option>
																																			<option value="SUM OF YEAR METHOD">SUM OF YEAR METHOD</option>
																</select>
																</span>
														 </div>
												 </div>

												 <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
														 <label for="rate" class="col-md-2 control-label">Rate</label>
														 <div class="col-md-10">
															 <span id="subo">

															 </span>
																 @if ($errors->has('rate'))
																		 <span class="help-block">
																				 <strong>{{ $errors->first('rate') }}</strong>
																		 </span>
																 @endif
														 </div>
												 </div>
																									<script type="text/javascript">
																													function myFunction()
																													{
																															//alert("seen");
																															/*var a = document.getElementById('isdepreciate').value;
																															alert(a);*/
																															document.getElementsByTagName("select")[0].setAttribute("hidden", "hidden");
																															document.getElementById('subz').innerHTML = "<p></p>";
																															//document.getElementsByTagName("h1")[0].setAttribute("class", "democlass");
																													}

																													function myFunctionn()
																													{
																															//alert("seen");
																															/*var a = document.getElementById('depreciationformula').value;
																															alert(a);*/
																															document.getElementsByTagName("select")[0].setAttribute("", "");
																															document.getElementById('subz').innerHTML = "<p></p>";

																															//document.getElementsByTagName("h1")[0].setAttribute("class", "democlass");
																													}

																													function rateChange()
																													{
																														var a = document.getElementById('depreciationformula').value;
																														if(a == "REDUCING BALANCE METHOD")
																														{
																															document.getElementById('subo').innerHTML = "<input id='rate' type='number' class='form-control' placeholder='Rate (Percentage)' name='rate' value='{{ old('rate') }}'  min='1'  >";
																															//document.getElementById('subo').innerHTML = "<input id='rate' type='hidden' class='form-control' placeholder='Rate (Percentage)' name='rate' value='{{ old('rate') }}'  min='1'  >";
																															//document.getElementsByTagName('select')[0].setAttribute("type", "number");
																															//alert(a);
																														}
																													}
																									</script>-->

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

                        <!--<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-2 control-label">Location</label>

                            <div class="col-md-10">
                                <textarea id="location" class="form-control" name="location" placeholder="Location"  ></textarea>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('supplier_details') ? ' has-error' : '' }}">
                            <label for="supplier_details" class="col-md-2 control-label">Supplier Details</label>

                            <div class="col-md-10">
                                <textarea id="supplier_details" class="form-control" name="supplier_details" placeholder="Enter suppliers details"  ></textarea>

                                @if ($errors->has('supplier_details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supplier_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Invoice/Voucher Number</label>

                            <div class="col-md-10">
                                <input id="invoice_number" type="text" class="form-control" placeholder="Invoice/Voucher Number" name="invoice_number" value="{{ old('invoice_number') }}"  >

                                @if ($errors->has('invoice_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->

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

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-2 control-label">Depreciation (Range)</label>

                            <div class="col-md-4">
                                <p>From: <input id="amount" type="number" class="form-control" name="depreciation_from" step="any" placeholder="Depreciation range(From)" min="1"  ></p>
                                <p>To: <input id="amount" type="number" class="form-control" name="depreciation_to" step="any" placeholder="Depreciation range(To)" min="1"  ></p>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                            <label for="purchase_date" class="col-md-2 control-label">Purchase Date</label>
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

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="classification" class="col-sm-2 control-label">Classification</label>
                            <div class="col-md-10">
                            <span>
                                 <select name ="classification" id="classification" class="form-control">
                                    <option value="None" selected="selected">All</option>
                                    @if (empty($classifications))
                                    <option value="There are no registered assets yet">There are no registered asset classes yet</option>
                                    @else
                                    @foreach($classifications as $classification)
                                    <option value="{{$classification->class_name}}">{{$classification->class_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </span>
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
