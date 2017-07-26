@extends('layouts.departments')
@section('title')
	Edit - {{$order->id}}
@stop

@section('body')
Request ID: <span>{{ $order->id }}</span>
<hr>
<center>
	{!!Form::model($order, [
		'method' => 'patch',
		'route' => ['departments.update', $order->id]
	])!!}

		<h3>Item: <span>{{ $order->order_item}}</span></h3>

		<h3>Description: </h3> <h3><span>{{ $order->description }}</span></h3>
		</br>

		{!!Form::label('quantity', 'Quantity')!!}
		{!!Form::number('quantity', $order->quantity, ['required', 'min'=>1] )!!}		
		</br>

		<h3>Ordered By: <span>{{ $order->made_by}}</span></h3>

		{!!Form::hidden('hod_approval', 'APPROVED', ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}
		</br>

		{!!Form::hidden('commment', 'NONE', ['placeholder' => 'Enter the model'], array('required' => 'required'))!!}

	<center>
	{!!Form::submit('Approve')!!}
	</center>
	{!!Form::close()!!}
</center>
@stop