@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                {!! Form::open(array('route' => ['auth.passwordreset', $passwordReset->token], 'method' => 'post')) !!}

                <h2>Password Reset</h2>
                <hr class="colorgraph">
                <p>Enter new password.</p>
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
                        {!! Form::submit('Reset', ['class'=>'btn btn-primary btn-block btn-lg']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection