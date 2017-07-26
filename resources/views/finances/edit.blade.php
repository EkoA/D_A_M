@extends('layouts.finances')
@section('title')
	Edit - {{$order->id}}
@stop

@section('body')
<center>
	{!!Form::model($order, [
		'method' => 'patch',
		'route' => ['finances.update', $order->id]
	])!!}

		<h3>Request ID: <span>{{ $order->id }}</span></h3>

		<h3>Item: <span>{{ $order->order_item}}</span></h3>

		<h3>Description: </h3> <h3><span>{{ $order->description }}</span></h3>
		</br>

		<h3>Quantity: </h3> <h3><span>{{ $order->quantity }}</span></h3>
		</br>

		<h3>Ordered By: <span>{{ $order->made_by}}</span></h3>

		{!!Form::hidden('finance_approval', 'APPROVED', ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}
		</br>

		{!!Form::hidden('commment', 'NONE', ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}

	<center>
	{!!Form::submit('Approve')!!}
	</center>
	{!!Form::close()!!}
</center>
@stop