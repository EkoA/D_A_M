@extends('layouts.orders')
@section('title')
	Approve - {{$order->order_item}}
@stop

@section('body')
<center>
	{!!Form::model($order, [
		'method' => 'patch',
		'route' => ['orders.update', $order->id]
	])!!}

		<h3>Request ID: <span>{{ $order->id }}</span></h3>

		<h3>Item: <span>{{ $order->order_item}}</span></h3>

		{!!Form::hidden('order_item', $order->order_item, ['placeholder' => 'Enter the model', 'required'], array('required' => 'required'))!!}

		<h3>Description: </h3> <h3><span>{{ $order->description }}</span></h3>

		{!!Form::hidden('description', $order->description, ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}

		{!!Form::label('quantity', 'Quantity')!!}
		{!!Form::number('quantity', $order->quantity, ['required'] )!!}
		</br>

		<h3>Department: <span>{{ $order->department}}</span></h3>

		{!!Form::hidden('admin_approval', 'DECLINED', ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}
		</br>

	<center>
	{!!Form::submit('Approve')!!}
	</center>
	{!!Form::close()!!}
</center>
@stop