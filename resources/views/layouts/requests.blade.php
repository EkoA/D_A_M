<!DOCTYPE html>
<html lang="en">
<head>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
      <meta name="author" content="Coderthemes">

      <link rel="shortcut icon" href="{{ asset('images/logo3.png') }}">

      <title>DAM</title>

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
        body {
            font-family: verdana;
        }

        .fa-btn {
            margin-right: 6px;
        }

        span{color:lightgreen;}

        input{border-radius: 7px;
              border: 1px solid lightgrey;}

        body{color: black;}

    </style>
</head>
<body id="app-layout">
        <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!--<ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->
                <a class="nav navbar-nav" href="{{ url('/') }}" class="">
                   <img class="logy" src="{{ asset('img/dream_logo_default.png') }}" alt="logo" width="70">
                </a>
            </div>
        </div>

        <div class="menubar">
                     <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
            </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!--<ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->

                <ul class="nav navbar-nav ">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a  href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a class="whitefont" href="{{ url('/users') }}">Manage Staff |</a></li>
                        <!--<li><a href="{{ url('/departments') }}">Manage Departments</a></li>-->
                        <li><a href="{{ url('/orders') }}">Manage Requests |</a></li>
                        <!--<li><a href="{{ url('/register') }}">Add Admin</a></li>-->
                        <li class="dropdown">
                            <a class="dropdown-toggle profile waves-effect waves-light"  href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i>Logout</a>
                        </li>

                    @endif
                </ul>
            </div>
        </div>
        </div>

    </nav>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li class="search">
                            <form method="get" action="{{ route('search.now') }}">
                                <input type="text" name="search" placeholder="  search..." required>
                                <input type="submit" name="search_btn" class="buttn" value="Search">
                            </form>
                        </li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('body')

</br>
</br>
</br>
</br>
</br>
</br>
</br>

<footer>
    <img src="{{ asset('img/Logo(4).png') }}" align="right" width="13%" height="10%"/>
    <p>Logged in as: <span>{{ Auth::user()->name }}</span> </p>
    <center>
        <p>Dream Mesh Ltd. &copy Copyright 2016. All rights reserved</p>
    </center>
</div>
</footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
