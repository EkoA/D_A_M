<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="An asset management system">
      <meta name="DreamMesh" content="DAMS">

      <link rel="shortcut icon" href="{{ asset('img/dream_logo_default.png') }}">

      <title>DAMS</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" media="all" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" media="all"href="{{ asset('css/core.css') }}" >
    <link rel="stylesheet" media="all" href="{{ asset('css/components.css') }}" >
    <link rel="stylesheet" media="all" href="{{ asset('css/icons.css') }}" >
    <link rel="stylesheet" media="all" href="{{ asset('css/pages.css') }}" >
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" >

<style>
  span{color:#7967A7;}
</style>

  </head>

  <body class="fixed-left">
  <!-- Begin page -->
  <div id="wrapper">

  <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
          <div class="text-center">
              <a href="{{ url('/finances') }}" class="logo"><img src="{{ asset('img/dream_logo_default.png') }}" style="height:auto; width:109px;"></a>
          </div>
      </div>

      <!-- Button mobile view to collapse sidebar menu -->
      <div class="navbar navbar-default" role="navigation">
          <div class="container">
              <div class="">
                  <div class="pull-left">
                      <button class="button-menu-mobile open-left waves-effect waves-light">
                          <i class="md md-menu"></i>
                      </button>
                      <span class="clearfix"></span>
                  </div>

                  <ul class="nav navbar-nav hidden-xs">
                      <li><a href="{{ url('/finances/approved') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Approved Requests</a></li>
                       <li><a href="{{ url('/finances/pending') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Pending Requests</a></li>
                       <li><a href="{{ url('finances/items') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Manage Assets</a></li>
                       <li><a href="{{ url('vendors/') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Manage Vendors</a></li>
                  </ul>

                  <form role="search" class="navbar-left app-search pull-left hidden-xs" method="GET" action="{{ route('orders.search') }}">
                       <input type="text" placeholder="Search..." class="form-control" name="search" required>
                       <a href=""><i class="fa fa-search"></i></a>
                  </form>

                  <ul class="nav navbar-nav navbar-right pull-right">
                      <li class="dropdown top-menu-item-xs">
                          <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                          </a>
                      </li>
                      <li class="dropdown top-menu-item-xs">
                        <a class="dropdown-toggle profile waves-effect waves-light"  href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i>Logout</a>
                      </li>
                  </ul>
              </div>
              <!--/.nav-collapse -->
          </div>
    </div>

  </div>
  <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
          <!--- Divider -->
          <div id="sidebar-menu">
              <ul>
                  <li class="text-muted menu-title">Navigation</li>
                  <li class="has_sub">
                      <a href="{{ url('/finances') }}" class="waves-effect"><i class="ti-home"></i> Dashboard </a>
                  </li>
                  <li class="has_sub">
                      <a href="{{ url('/finances/approved') }}" class="waves-effect"><i class="ti-pencil-alt"></i>Approved Requests</a>
                  </li>
                  <li class="has_sub">
                      <a href="{{ url('/finances/pending') }}" class="waves-effect"><i class="ti-pencil-alt"></i>Pending Requests</a>
                  </li>
                  <li class="has_sub">
                      <a href="{{ url('/finances/order') }}" class="waves-effect"><i class="fa fa-plus"></i>Request Item</a>
                  </li>
                  <li class="has_sub">
                      <a href="{{ url('/orders/reports') }}" class="waves-effect"><i class="fa fa-plus"></i>Request Report</a>
                  </li>
              </ul>
              <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
      </div>
  </div>

    @yield('body')

<footer class="footer">
   Last login <label class="control-label">{{ Auth::user()->last_login }}</label>&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;Logged in as: <label class="control-label">{{ Auth::user()->name }}</label>&nbsp;&nbsp;&nbsp;|  2017 © Dream Mesh. All rights reserved.
</footer>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
