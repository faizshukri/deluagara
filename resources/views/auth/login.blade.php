<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                <form role="form" method="POST" action="{{ route('auth.login') }}">
                    {!! csrf_field() !!}

                    <h2>Login</h2>
                    <hr class="colorgraph">
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <input autofocus type="email" name="email" value="{{ old('email') }}" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="1">
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>
                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
                        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" tabindex="3" style="font-size: 16px;"> Remember me
                        </label>
                    </div>

                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection