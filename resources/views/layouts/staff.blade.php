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
            <a href="{{ url('/home') }}" class="logo"><img src="{{ asset('img/dream_logo_default.png') }}" style="height:auto; width:109px;"></a>
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

                @if (Auth::guest())
                    <li><a  href="{{ url('/login') }}">Login</a></li>
                @else
                <ul class="nav navbar-nav hidden-xs">
                    <li><a href="{{ url('/users') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Manage Staff</a></li>
                     <li><a href="{{ url('/orders') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Manage Requests</a></li>
                     <li><a href="{{ url('/asset') }}" style="font-family: inherit;
">&nbsp;&nbsp;&nbsp;Manage Assets</a></li>
                </ul>

                <form role="search" class="navbar-left app-search pull-left hidden-xs" method="get" action="{{ route('users.search') }}">
                     <input type="text" placeholder="Search..." class="form-control" name="search" required>
                     <a href=""><i class="fa fa-search"></i></a>
                </form>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown top-menu-item-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">

                            <i class="icon-bell"></i> <span class="badge badge-xs badge-danger"></span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg">
                            <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                            <li class="list-group slimscroll-noti notification-list">
                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-diamond noti-primary"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                        <p class="m-0">
                                            <small>There are new settings available</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>

                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-cog noti-warning"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">New settings</h5>
                                        <p class="m-0">
                                            <small>There are new settings available</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>

                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-bell-o noti-custom"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">Updates</h5>
                                        <p class="m-0">
                                            <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>

                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-user-plus noti-pink"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">New user registered</h5>
                                        <p class="m-0">
                                            <small>You have 10 unread messages</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>

                                <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-diamond noti-primary"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                        <p class="m-0">
                                            <small>There are new settings available</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>

                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="pull-left p-r-10">
                                        <em class="fa fa-cog noti-warning"></em>
                                     </div>
                                     <div class="media-body">
                                        <h5 class="media-heading">New settings</h5>
                                        <p class="m-0">
                                            <small>There are new settings available</small>
                                        </p>
                                     </div>
                                  </div>
                               </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="list-group-item text-right">
                                    <small class="font-600">See all notifications</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a class="dropdown-toggle profile waves-effect waves-light"  href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i>Logout</a>
                    </li>
                    @endif
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
                    <a href="{{ url('/home') }}" class="waves-effect"><i class="ti-home"></i> Dashboard </a>
                </li>
                <li class="has_sub">
                    <a href="{{ url('/departments/deptcreate') }}" class="waves-effect"><i class="ti-pencil-alt"></i>Manage Departments</a>
                </li>
                <li class="has_sub">
                    <a href="{{ url('/users') }}" class="waves-effect"><i class="ti-pencil-alt"></i>View Staff</a>
                </li>
                <li class="has_sub">
                    <a href="{{ url('/users/create') }}" class="waves-effect"><i class="fa fa-plus"></i>Add Staff</a>
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
