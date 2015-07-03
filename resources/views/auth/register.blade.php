<!-- resources/views/auth/register.blade.php -->
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="POST" action="{{ route('auth.register') }}">
                {!! csrf_field() !!}

                <h2>Please Sign Up <small>It's free and always will be.</small></h2>
                <hr class="colorgraph">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <input autofocus type="text" name="name" value="{{ old('name') }}" id="name" class="form-control input-lg" placeholder="Full Name" tabindex="1">
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="2">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
                            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
                        </div>
                    </div>
                </div>

                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
                </div>
            </form>
        </div>
    </div>

@endsection