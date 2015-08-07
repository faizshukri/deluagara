@extends('layouts/master')

@section('content')
    <div class="row">
        <div class="col-sm-12 wrapper404">
            <div class="content">
                <img src="/images/int-error-img.png" title="error"/>
                <p><span><label style="font-size: inherit;">O</label>uchh....</span> Sorry, the server encountered an internal error.</p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Back To Home</a>
            </div>
        </div>
    </div>
@endsection

@section('header')
    <link rel="stylesheet" href="{{ elixir('css/404.css') }}">
@endsection