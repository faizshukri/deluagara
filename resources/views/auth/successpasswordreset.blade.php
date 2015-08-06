@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                <h2>Password Reset</h2>
                <hr class="colorgraph">
                <p>Your password has been change. You can now login using your new password.</p>
                <a href="{{ route('auth.login') }}" class="btn btn-primary">Go to login</a>
                <hr class="colorgraph">
            </div>
        </div>
    </div>

@endsection