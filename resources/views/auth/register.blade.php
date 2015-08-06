<!-- resources/views/auth/register.blade.php -->
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                {!! Form::open(array('route' => 'auth.register', 'method' => 'post')) !!}

                    <h2>Please Sign Up <small>It's free and always will be.</small></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::text('name', old('name'), ['class' => 'form-control input-lg', 'autofocus' => true, 'placeholder' => 'Full Name']) !!}
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <div class="form-group @if ($errors->has('username')) has-error @endif">
                                {!! Form::text('username', old('username'), ['class' => 'form-control input-lg', 'placeholder' => 'User Name']) !!}
                                @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        {!! Form::email('email', old('email'), ['class' => 'form-control input-lg', 'placeholder' => 'Email Address']) !!}
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {!! Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']) !!}
                                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => 'Confirm Password']) !!}
                            </div>
                        </div>
                    </div>

                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! Form::submit('Register', ['class'=>'btn btn-primary btn-block btn-lg']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection