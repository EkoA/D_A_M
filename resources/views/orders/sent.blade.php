@extends('layouts.requests')
@section('title')
	All Sent Requests
@stop

@section('body')
<center>
	<table class="table table-hover">
			<caption>Pending Requests</caption>
			<tr><th>Request ID &nbsp;</th><th>&nbsp;Item&nbsp;</th><th>&nbsp;Status</th></tr>
	@foreach($orders as $order)

			<tr><td>{{$order->id}}</td><td>{{$order->order_item}}&nbsp;</td><td>&nbsp;{{$order->status}}&nbsp;</td></tr>

	@endforeach

	</table>
			<!--<a href="{{route('orders.create')}}">Add New order</a>-->
</center>
@stop
