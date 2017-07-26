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
												<h4 class="page-title">Add Assets (Excel)</h4>
												<ol class="breadcrumb">

												</ol>
											</div>
										</div>

<div class="row">
		<div class="col-sm-12">
				<div class="card-box">
					<h5 class="m-t-0 header-title"><b>Asset Registration Form </b></h5>

					<center>

					@if(isset($ret))
							<span><?php echo $ret;?>
					@endif
					</center>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('items.massstore') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('excelitem') ? ' has-error' : '' }}">
                            <label for="excelitem" class="col-md-2 control-label">Excel file of assets</label>

                            <div class="col-md-10">
                                <input id="excelitem" type="file" class="form-control" accept=".xls,.xlsx,.csv" name="excelitem" placeholder="Asset Name" value="{{ old('item') }}" required>
                                @if ($errors->has('excelitem'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('excelitem') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus" ></i> Upload
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
