@extends('layouts.vendors')
@section('title')
	Add new Vendor
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
												<h4 class="page-title">Add Vendor</h4>
												<ol class="breadcrumb">

												</ol>
											</div>
										</div>

<div class="row">
		<div class="col-sm-12">
				<div class="card-box">
					<h5 class="m-t-0 header-title"><b>Vendor Registration Form</b></h5>

					<center>
					<?php
							//$ret = $_GET["ret"];
							if(isset($_GET["ret"]))
							{
									$ret = $_GET["ret"];
							}
							//echo $ret;
					?>

          @if(isset($ret))
              <span><?php echo $ret;?>
          @endif
					</center>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('vendors.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }}">
                            <label for="vendor_name" class="col-md-2 control-label">Company Name</label>

                            <div class="col-md-10">
                                <input id="item" type="text" class="form-control" name="vendor_name" placeholder="Vendor Name" value="{{ old('vendor_name') }}" required>
                                @if ($errors->has('vendor_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vendor_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vat_num') ? ' has-error' : '' }}">
                            <label for="vat_num" class="col-md-2 control-label">VAT Reg no</label>

                            <div class="col-md-10">
                                <input id="vat_num" type="text" class="form-control" name="vat_num" placeholder="VAT Reg no" value="{{ old('vat_num') }}" >
                                @if ($errors->has('vat_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vat_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-2 control-label">Address</label>

                            <div class="col-md-10">
                                <textarea id="address" class="form-control" name="address" placeholder="Enter address here" required></textarea>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

												<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-2 control-label">Phone</label>
                            <div class="col-md-10">
                                <input id="phone" type="number" class="form-control" name="phone" placeholder="Phone Number" min="1" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

												<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
														<label for="email" class="col-md-2 control-label">Email</label>
														<div class="col-md-10">
																<input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

																@if ($errors->has('email'))
																		<span class="help-block">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>

												<div class="form-group{{ $errors->has('product_service') ? ' has-error' : '' }}">
														<label for="product_service" class="col-md-2 control-label">Product/Service</label>
														<div class="col-md-8">

                              <select class="form-control" name ="product_service" id="product_service" required>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Construction and building repairs">Construction and building repairs</option>
                                <option value="Paper & printing jobs">Paper & printing jobs</option>
                                <option value="Newspaper and publication">Newspaper and publication</option>
                                <option value="Health practitioner">Health practitioner</option>
                                <option value="Intercoms & communication services">Intercoms & communication services</option>
                                <option value="Carpentry & furniture repairs">Carpentry & furniture repairs</option>
                                <option value="Oil and gas">Oil and gas</option>
                                <option value="Cleaning Services">Cleaning Services</option>
                                <option value="Office supplies and stationeries">Office supplies and stationeries</option>
                                <option value="Plumbing works">Plumbing works</option>
                                <option value="Electronics sales and repair">Electronics sales and repair</option>
                                <option value="Internal design and internal branding">Internal design and internal branding</option>
                              </select>
														</div>
												</div>

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-2 control-label">Comments</label>

                            <div class="col-md-10">
                                <textarea id="comments" class="form-control" name="comments" placeholder="Comments" ></textarea>

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input id="created_by" type="hidden" class="form-control" name="created_by" value="{{Auth::user()->name}}" required>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus" ></i> Add
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
