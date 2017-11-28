@extends('layouts.basic')
@section('title')
	Approve - {{$order->item}}
@stop

@section('body')
Request Item

<center>
    <table class="table table-hover">
    @if (empty($orders))
        <p>There are no requests yet</p>
    @else
            <caption>Suggestions</caption>
    @foreach($orders as $orders)

        <tr onclick="document.location='{{route('orders.edit', $orders->id)}}'" style="cursor:hand" ><td>{{$orders->order_item}}</td><td>{{$orders->description}}</td></tr>

    @endforeach
    @endif
    </table>
</center>

<hr>
                	<center>
                    <?php
                        //$ret = $_GET["ret"];
                        if(isset($_GET["res"]))
                        {
                            $res = $_GET["res"];
                        }

                    ?>

                    @if(isset($_GET["res"]))

                        <div class="">
                            <h4><span><?php echo $res; ?></span></h4>
                        </div>
                    @endif
                    </center>


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('orders.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Item</label>

                            <div class="col-md-6">
                                <input id="order_item" type="text" class="form-control" name="order_item" value="{{ $order->order_item}}" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order_item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="email" type="description" class="form-control" name="description" value="{{ $order->description }}" required>{{ $order->description }}</textarea>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Quantity</label>

                          <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control" name="quantity"  value="1" min="1" required>

                                @if ($errors->has('order_item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                            <input id="admin_approval" type="hidden" class="form-control" name="admin_approval" value="PENDING" required>
                            <input id="finance_approval" type="hidden" class="form-control" name="finance_approval" value="PENDING" required>
                            <input id="hod_approval" type="hidden" class="form-control" name="hod_approval" value="PENDING" required>
                            <input id="department" type="hidden" class="form-control" name="department" value="{{$user->department}}" required>
                            <input id="made_by" type="hidden" class="form-control" name="made_by" value="{{$user->name}}" required>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Request
                                </button>
                            </div>
                        </div>
                    </form>
                    &nbsp;
                    &nbsp;
                    <br>
                    <br>
                    <br>

	{!!Form::close()!!}
</center>
@stop
