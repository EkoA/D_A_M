@extends('layouts.items')
@section('title')
	{{$item->item_type}} | {{$item->item_model}}
@stop
@section('body')
Asset disposal
<hr>
{{$item->item}} | <span>{{$item->asset_number}}</span>

  <table class="table table-hover">
  <tr><td>Serial Number</td><td class="whitebox" ><span>{{ $item->serialno}}</span></td></tr>
  <tr><td>Description</td><td class="whitebox" ><span>{{ $item->description }}</span></td></tr>
  <tr><td>Department</td><td class="whitebox" ><span>{{ $item->department }}</span></td></tr>
  <tr><td>Classification</td><td class="whitebox" ><span>{{ $item->classification }}</span></td></tr>
  <tr><td>Supplier</td><td class="whitebox" ><span>{{ $item->supplier_details }}</span></td></tr>
  <tr><td>Cost (&#8358)</td><td class="whitebox" ><span>{{ $item->amount }}</span></td></tr>
  <tr><td>Economic Life</td><td class="whitebox" ><span>{{ $item->economiclife }}</span></td></tr>
  <tr><td>Depreciable?</td><td class="whitebox" ><span>{{ $item->isdepreciate }}</span></td></tr>
  @if ($item->isdepreciate == 'Yes')
    <tr><td>Depreciation Formula</td><td class="whitebox" ><span>{{ $item->depreciationformula }}</span></td></tr>
    @endif
    <tr><td>Purchase Date</td><td class="whitebox" ><span>{{ $item->purchase_date }}</span></td></tr>
  </table>
<div class="itbox">
  	<h4>Dispose {{$item->item}} | <span>{{$item->asset_number}}</span></h4>
  	<br>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('items.disposal', $item->id) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
            <label for="amount" class="col-md-4 control-label">Agreed amount</label>

            <div class="col-md-6">
                <input id="amount" type="number" class="form-control" name="agreed_price" step="any" placeholder="Agreed price" value="0" min="0" required>

                @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Invoice Number</label>

            <div class="col-md-6">
                <input id="invoice_number" type="text" class="form-control" placeholder="Sales Invoice Number" name="sales_invoice" value="{{ old('invoice_number') }}" required>

                @if ($errors->has('invoice_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('invoice_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('supplier_details') ? ' has-error' : '' }}">
            <label for="supplier_details" class="col-md-4 control-label">Further Info</label>

            <div class="col-md-6">
                <textarea id="further_info" class="form-control" name="further_info" placeholder="Any other thing" required></textarea>

                @if ($errors->has('further_info'))
                    <span class="help-block">
                        <strong>{{ $errors->first('further_info') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         <div class="form-group{{ $errors->has('disposal_date') ? ' has-error' : '' }}">
            <label for="disposal_date" class="col-md-4 control-label">Disposal Date</label>
            <?php
                $dat = date("Y-m-d");
            ?>
            <div class="col-md-6">
                <input id="disposal_date" type="date" class="form-control" name="disposal_date" placeholder="Date of purchase" value="0" max="<?php echo $dat; ?>" required>

                @if ($errors->has('purchase_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('disposal_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <input id="disposal_status" type="hidden" class="form-control" name="disposal_status" value="PENDING" required>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i> DISPOSE
                </button>
            </div>
        </div>

    </form>
</div>
@stop
