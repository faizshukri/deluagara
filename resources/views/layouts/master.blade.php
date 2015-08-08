<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#">
<head>
    <title>Katsitu - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @yield('meta')

    {{-- Open graph --}}
    <meta property="og:title" content="Katsitu.Com - @yield('title')" />
    <meta property="og:url" content="{{ Request::url() }}" />

    {{-- Stylesheet --}}
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

    @include('layouts.analytic')
</body>
</html>
