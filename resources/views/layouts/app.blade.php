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
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="logo"><img src="{{ asset('img/dream_logo_default.png') }}" style="height:auto; width:109px;"></a>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!--<ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())


                    @else
                        <li class="dropdown">
                              <a class="dropdown-toggle profile waves-effect waves-light"  href="{{ url('/logout') }}"><i class="ti-power-off m-r-10 text-danger"></i>Logout</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')


<footer>
    <!--<img src="{{ asset('img/Logo(4).png') }}" align="right" width="13%" height="10%"/>
    <center>
        <p>Dream Mesh Ltd. &copy Copyright 2016. All rights reserved</p>
    </center>-->
</div>
</footer>

<script>
      var resizefunc = [];
</script>

<script src="assets('js/jquery.min.js')"></script>
<script src="assets('js/bootstrap.min.js')"></script>
<script src="assets('js/detect.js')"></script>
<script src="assets('js/fastclick.js')"></script>
<script src="assets('js/jquery.slimscroll.js')"></script>
<script src="assets('js/jquery.blockUI.js')"></script>
<script src="assets('js/waves.js')"></script>
<script src="assets('js/wow.min.js')"></script>
<script src="assets('js/jquery.nicescroll.js')"></script>
<script src="assets('js/jquery.scrollTo.min.js')"></script>


<script src="assets('js/jquery.core.js')"></script>
<script src="assets('js/jquery.app.js')"></script>

</body>
</html>
