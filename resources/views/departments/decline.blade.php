@extends('layouts.departments')
@section('title')
	Edit - {{$order->id}}
@stop

@section('body')
<center>
	{!!Form::model($order, [
		'method' => 'patch',
		'route' => ['departments.update', $order->id]
	])!!}

		<h3>Request ID: <span>{{ $order->id }}</span></h3>

		<h3>Item: <span>{{ $order->order_item}}</span></h3>

		<h3>Description: </h3> <h3><span>{{ $order->description }}</span></h3>

		<h3>Quantity: <span>{{ $order->quantity}}</span></h3>

		{!!Form::hidden('quantity', $order->quantity, ['required'] )!!}

		<h3>Ordered By: <span>{{ $order->made_by}}</span></h3>

		<h3>Comment:</h3>
		{!!Form::textarea('comment', null, ['required'])!!}	
		</br>

		{!!Form::hidden('hod_approval', 'DECLINED' )!!}
		</br>

	<center>
	{!!Form::submit('Decline')!!}
	</center>
	{!!Form::close()!!}
</center>
@stop