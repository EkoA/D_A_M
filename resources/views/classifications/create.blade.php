@extends('layouts.items')
@section('title')
	Add new Asset Classification
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

										<h4 class="page-title">Add Asset Class</h4>
										<ol class="breadcrumb">

										</ol>
									</div>
								</div>

<div class="row">
<div class="col-sm-12">
		<div class="card-box">
			<h5 class="m-t-0 header-title"><b>Add Asset Classification</b></h5>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('classifications.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                            <label for="item" class="col-md-2 control-label">Classification</label>

                            <div class="col-md-10">
                                <input id="item" type="text" class="form-control" name="class_name" placeholder="Name of asset classification" value="{{ old('item') }}" required>

                                @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-2 control-label">Description</label>

                            <div class="col-md-10">
                                <textarea id="description" class="form-control" name="description" placeholder="Enter description here" required></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Short Code</label>
                            <div class="col-md-10">
                                <input id="invoice_number" type="text" class="form-control" placeholder="Short code" name="short_code" value="{{ old('short_code') }}" maxlength="2" required>

                                @if ($errors->has('short_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add
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
