@if (Auth::guest())
@extends('layouts.app')
@section('content')
<div class="account-pages"></div>
    <div class="clearfix"></div>
        <div class="wrapper-page">
              <div class=" card-box1">
                  <div class="panel-heading">
                     <div align="center"> <img src="{{ asset('img/dream_logo_default.png') }}" style="height:auto; width:220px;"></div>
                    </div>

                    <?php
                    //  echo $msg;
                        if(isset($_COOKIE['cooks']))
                        {
                          echo "<center><span style='color:red;'>".$_COOKIE['cooks']."</span></center>";
                          echo "</br>";
                          setcookie("cooks", "", time() - 3600);
                        }
                    ?>
                <div class="panel-body">
                  <form class="form-horizontal m-t-20" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                        <div class="form-group form-group{{ $errors->has('staffid') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" type="text"  placeholder="Staff ID" name="staffid" value="{{ old('staffid') }}" style="background-color:#CCC;" required>
                                @if ($errors->has('staffid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('staffid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" id="password" name="password"type="password" placeholder="Password" style="background-color:#CCC;" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" name="remember">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@else
     <?php
        return Redirect::url('/home');
     ?>
@endif

@endsection
