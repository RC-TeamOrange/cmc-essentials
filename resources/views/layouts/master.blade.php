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
    </head>
    
    <body>
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