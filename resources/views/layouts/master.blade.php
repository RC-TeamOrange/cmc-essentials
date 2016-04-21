<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CMC-Essentials</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://www.google.com/fonts#UsePlace:use/Collection:Roboto:400,400italic,300,100,300italic,700,500" rel="stylesheet" type="text/css">
        <link href="https://www.google.com/fonts#UsePlace:use/Collection:Raleway:400,500,300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cmc-essentials.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="{{ asset('js/cmc-essentials.js') }}"></script>
    </head>
    
    <body>
	<nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                      <span class="sr-only">Menu</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">CMC-Essentials</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="https://github.com/RC-TeamOrange/cmc-essentials" target="_blank">View on GitHub<span class="sr-only">(current)</span></a></li>
                      <li><a href="http://rc-teamorange.github.io/cmc-essentials/" target="_blank">Documentation</a></li>
		      <li><a href="{{url('/')}}">About</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Logged in as: Anonymous</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
        <div class="container">
            <div class="page-header">
                @yield('header')
            </div>
            
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </body>
</html>
