@extends('layouts.items')
@section('title')
@stop

@section('body')
<center>
<div style="text-align: left">Classification of Assets</div>
<hr>
<div class="table table-hover">
<table>
    @if (empty($classifications))
        <p>There are no registered asset classes</p>
    @else

            <tr><th>&nbsp;Short Code&nbsp;</th><th>&nbsp;Classification&nbsp;</th><th>&nbsp;Description&nbsp;</th></tr>
    @foreach($classifications as $classification)
            <tr onclick="document.location='{{route('classifications.show', $classification->id)}}'" style="cursor:hand"><td>&nbsp;{{$classification->short_code}}&nbsp;</td><td>&nbsp;{{$classification->class_name}}&nbsp;</td><td>&nbsp;{{$classification->description}}&nbsp;</td></tr>
    @endforeach
    @endif
</table>
</div>

</center>
@stop
