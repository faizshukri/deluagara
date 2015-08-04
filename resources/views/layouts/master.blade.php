<!DOCTYPE html>
<html lang="en">
<head>
    <title>Katsitu - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ elixir('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    @yield('header')
</head>
<body>
    <div class="main-wrapper">

        @unless($hideNavbar)
            @include('layouts.navbar')
        @endunless

        @include('partials.flash')

        @yield('map-front')

        <div class="container" id="deluagara">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>
</body>
</html>
