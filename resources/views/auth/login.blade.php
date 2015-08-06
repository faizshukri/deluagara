<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                {!! Form::open(array('route' => 'auth.login', 'method' => 'post')) !!}

                    <h2>Login</h2>
                    <hr class="colorgraph">
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        {!! Form::email('email', old('email'), ['class' => 'form-control input-lg', 'autofocus' => true, 'placeholder' => 'Email Address']) !!}
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>
                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        {!! Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']) !!}
                        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="checkbox" style="margin-top: 0px; margin-bottom: 0px; font-size: 13px;">
                                <label>
                                    {!! Form::checkbox('remember', 1, false, [ 'style' => 'font-size: 16px' ]) !!}  Remember me
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="pull-right" style="margin-top: 0px; margin-bottom: 0px; font-size: 13px;">
                                <a href="{{ route('auth.forgotpassword') }}">Forgot password?</a>
                            </div>
                        </div>
                    </div>

                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! Form::submit('Login', ['class'=>'btn btn-primary btn-block btn-lg']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection