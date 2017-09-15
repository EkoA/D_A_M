@extends('layouts.vendors')
@section('title')
	Vendor | {{$vendor->vendor_name}}
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
												<h4 class="page-title">Edit Vendor</h4>
												<ol class="breadcrumb">

												</ol>
											</div>
										</div>

<div class="row">
		<div class="col-sm-12">
				<div class="card-box">
					<h5 class="m-t-0 header-title"><b></b></h5>

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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('vendors.update', $vendor->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }}">
                            <label for="vendor_name" class="col-md-2 control-label">Company Name</label>

                            <div class="col-md-10">
                                <input id="item" type="text" class="form-control" name="vendor_name" placeholder="Vendor Name" value="{{$vendor->vendor_name}}" required>
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
                                <input id="vat_num" type="text" class="form-control" name="vat_num" placeholder="VAT Reg no" value="{{$vendor->vat_num}}" >
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
                                <input id="address" type="text" class="form-control" name="address" placeholder="Vendor Name" value="{{$vendor->address}}" required>

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
                                <input id="phone" type="number" class="form-control" name="phone" placeholder="Phone Number" min="1" value="{{$vendor->phone}}" required>

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
																<input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{$vendor->email}}" required>

																@if ($errors->has('email'))
																		<span class="help-block">
																				<strong>{{ $errors->first('email') }}</strong>
																		</span>
																@endif
														</div>
												</div>

                        <div class="form-group{{ $errors->has('product_service') ? ' has-error' : '' }}">
                        <div class="col-md-8">
                          <center>
                            <h4>Products/Service</h4>
                            <h5>{{$vendor->product_service}}</h5>
                          </center>
                        </div>
                      </div>

												<div class="form-group{{ $errors->has('product_service') ? ' has-error' : '' }}">
														<label for="product_service" class="col-md-2 control-label">Product/Service</label>
														<div class="col-md-8">
                              <input type="checkbox" name="product_service[]" value="Hospitality">Hospitality &nbsp;
                              <input type="checkbox" name="product_service[]" value="Construction and building repairs">Construction and building repairs &nbsp;
                              <input type="checkbox" name="product_service[]" value="Paper & printing jobs">Paper & printing jobs&nbsp;<br/><br/>
                              <input type="checkbox" name="product_service[]" value="Newspaper and publication">Newspaper and publication &nbsp;
                              <input type="checkbox" name="product_service[]" value="Health practitioner">Health practitioner &nbsp;
                              <input type="checkbox" name="product_service[]" value="Intercoms & communication services">Intercoms & communication services &nbsp;<br/><br/>
                              <input type="checkbox" name="product_service[]" value="Carpentry & furniture repairs">Carpentry & furniture repairs &nbsp;
                              <input type="checkbox" name="product_service[]" value="Oil and gas">Oil and gas &nbsp;
                              <input type="checkbox" name="product_service[]" value="Cleaning Services">Cleaning Services &nbsp;<br/><br/>
                              <input type="checkbox" name="product_service[]" value="Office supplies and stationeries">Office supplies and stationeries &nbsp;
                              <input type="checkbox" name="product_service[]" value="Plumbing works">Plumbing works &nbsp;
                              <input type="checkbox" name="product_service[]" value="Electronics sales and repair">Electronics sales and repair &nbsp;
                              <input type="checkbox" name="product_service[]" value="Internal design and internal branding">Internal design and internal branding
														</div>
												</div>

                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label for="comments" class="col-md-2 control-label">Comments</label>

                            <div class="col-md-10">
                                <input id="comments" type="text" class="form-control" name="comments" placeholder="Comments" min="1" value="{{$vendor->comments}}" required>

                                @if ($errors->has('comments'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
