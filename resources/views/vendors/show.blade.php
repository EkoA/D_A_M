@extends('layouts.vendors')
@section('title')
	{{$vendor->vendor_name}}
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
				<h4 class="page-title">Vendor | <span>{{$vendor->vendor_name}}</span></h4>
				<ol class="breadcrumb">

				</ol>
		</div>
</div>

<div class="row">
 <div class="col-sm-2"></div>
		<div class="col-sm-8">
				<div class="card-box table-responsive">
					<table id="datatable" class="table table-hover">
	<tr><td>Vendor</td><td class="whitebox" ><span>{{$vendor->vendor_name}}</span></td></tr>
  <tr><td>VAT Reg no</td><td class="whitebox" ><span>{{$vendor->vat_num}}</span></td></tr>
	<tr><td>Address</td><td class="whitebox" ><span>{{$vendor->address}}</span></td></tr>
	<tr><td>Phone</td><td class="whitebox" ><span>{{$vendor->phone}}</span></td></tr>
	<tr><td>Email</td><td class="whitebox" ><span>{{$vendor->email}}</span></td></tr>
	<tr><td>Product Service</td><td class="whitebox" ><span>{{$vendor->product_service}}</span></td></tr>
	<tr><td>Comments </td><td class="whitebox" ><span>{{$vendor->comments}}</span></td></tr>
	<tr><td>Date Added </td><td class="whitebox" ><span>{{$vendor->created_at }}</span></td></tr>
	</table>
  <p align="center"> <a href="{{route('vendors.edit', $vendor->id)}}">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<form action="{{route('vendors.destroy', $vendor->id)}}" method="post">{{ csrf_field() }}{{ method_field('DELETE') }} <input name="delete" type="submit" value="Delete"/></form></a></p>

</div>
</div>
<div class="col-sm-2"></div>
</div>
@stop
