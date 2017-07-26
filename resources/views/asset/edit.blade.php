@extends('layouts.asset')
@section('title')
    Edit - {{$item->item_type}} | {{$item->item_model}}
@stop

@section('body')
Edit | {{$item->asset_number}}
<hr>
<center>

<form class="form-horizontal" role="form" method="POST" action="{{ route('items.update', $item->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                            <label for="item" class="col-md-4 control-label">Item</label>

                            <div class="col-md-6">
                                <input id="item" type="text" class="form-control" name="item" value="{{$item->item}}" required>

                                @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input type="text" id="description" class="form-control" name="description" value="{{$item->description}}" placeholder="Enter description here" required>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <center><h4>Current Department: <span>{{$item->department}}</span></h4></center>
                        </div>

                         <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                            <span>
                                <select name ="department" id="department">
                                   @if (empty($departments))
                                   <option value="None">There are no departments yet</option>
                                   @else
                                   @foreach($departments as $department)
                                   <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>

                                   @endforeach
                                   @endif
                               </select>
                            </span>
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input type="text" id="location" class="form-control" name="location" placeholder="Location" value="{{$item->location}}" required>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('supplier_details') ? ' has-error' : '' }}">
                            <label for="supplier_details" class="col-md-4 control-label">Supplier Details</label>

                            <div class="col-md-6">
                                <input type="text" id="supplier_details" class="form-control" name="supplier_details" value="{{$item->supplier_details}}" placeholder="Enter suppliers details" required>

                                @if ($errors->has('supplier_details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supplier_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Invoice Number</label>

                            <div class="col-md-6">
                                <input id="invoice_number" type="text" class="form-control" value="{{$item->invoice_number}}" placeholder="Invoice Number" name="invoice_number" value="{{ old('invoice_number') }}" required>

                                @if ($errors->has('invoice_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="{{$item->amount}}" placeholder="Amount or Cost" value="0" required>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                            <label for="purchase_date" class="col-md-4 control-label">Purchase Date</label>

                            <div class="col-md-6">
                                <input id="purchase_date" type="date" class="form-control" value="{{$item->purchase_date}}" placeholder="Date of purchase" value="0" required>

                                @if ($errors->has('purchase_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('purchase_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <center><h4>Current Classification: <span>{{$item->classification}}</span></h4></center>
                        </div>

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="classification" class="col-md-4 control-label">Classification</label>

                            <div class="col-md-6">
                            <span>

                                 <select name ="classification" id="classification">
                                  <option value="Plant & Machinery">Plant & Machinery</option>
                                  <option value="Office Equipment">Office Equipment</option>
                                  <option value="Furniture & Fittings">Furniture & Fittings</option>
                                </select>
                            </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Edit
                                </button>
                            </div>
                        </div>
</form>
                    <br>
                    <br>
                    <br>
               </div>
            </div>
        </div>
    </div>
</div>
</center>
@stop
