@extends('layouts.applogin')

@section('title')
    Change Password - {{$user}}
@stop

@section('content')
<div class="account-pages"></div>
    <div class="clearfix"></div>
        <div class="wrapper-page">
              <div class=" card-box1">
                  <div class="panel-heading">
                     <div align="center"> <h3>Change Password</h3></div>
                    </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('users.resetpassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control"  placeholder="Password" id="password" type="password" name="password" style="background-color:#CCC;" onchange="checkerr()" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control"  placeholder="re-enter Password" id="password-confirm" type="password"  name="password_confirmation" style="background-color:#CCC;" onchange="checker()" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <script type="text/javascript">
                          function checker()
                          {
                            var a = document.getElementById('password').value;
                            //alert("Hello");
                            var b = document.getElementById('password-confirm').value;

                            if(a != b)
                            {
                              alert('Both Passwords are not the same');
                              document.getElementById('subo').innerHTML = "<p></p>";
                            }
                            else
                            {
                              document.getElementById('subo').innerHTML ="<button type='submit' class='btn btn-primary'><i class='fa fa-btn fa-user'></i> Change</button>";
                            }
                          }

                          function checkerr()
                          {

                            var a = document.getElementById('password').value;
                            //alert("Hello");

                            var b = document.getElementById('password-confirm').value;

                            if(b)
                            {
                              if(a != b)
                              {
                                alert('Both Passwords are not the same');
                                document.getElementById('subo').innerHTML = "<p></p>";
                              }
                              else
                              {
                                document.getElementById('subo').innerHTML ="<button type='submit' class='btn btn-primary'><i class='fa fa-btn fa-user'></i> Change</button>";
                              }
                            }
                            else
                            {

                            }
                          }
                        </script>

                        {!!Form::hidden('account_activated', 'YES', ['placeholder' => 'Role ID'] )!!}


                        <div class="form-group">
                            <div class="btn btn-default">
                              <span id="subo">

                              </span>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
