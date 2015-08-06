@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <p class="clearfix">&nbsp;</p>
            <div class="panel-wrapper">
                {!! Form::open(array('route' => 'auth.forgotpassword', 'method' => 'post')) !!}

                <h2>Reset Password</h2>
                <hr class="colorgraph">
                <p>Enter your email address. We will send an email with a reset link to you.</p>
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::email('email', old('email'), ['class' => 'form-control input-lg', 'autofocus' => true, 'placeholder' => 'Email Address']) !!}
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>

                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-block btn-lg']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection