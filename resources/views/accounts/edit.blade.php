@extends('layouts.master')

@section('content')
    @inject('progress', 'Katsitu\Contracts\Progress')

    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Edit Account</h2>
            {!! Form::model($user, ['route' => ['account.update'], 'class' => 'form-horizontal', 'files' => 'true' ]) !!}
            {!! Form::token() !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Account Information</h3>
                </div>
                <div class="panel-body">

                    {{-- Username --}}
                    <div class="form-group @if ($errors->has('username')) has-error @endif">
                        {!! Form::label('username', 'Username', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('username', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        {!! Form::label('email', 'Email', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('email', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                        </div>
                    </div>


                    {{-- Old Password --}}
                    <div class="form-group @if ($errors->has('old_password')) has-error @endif">
                        {!! Form::label('old_password', 'Old Password', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::password('old_password', ['class'=>'form-control']) !!}
                            @if ($errors->has('old_password')) <p class="help-block">{{ $errors->first('old_password') }}</p> @endif
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        {!! Form::label('password', 'New Password', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                        </div>
                    </div>

                    {{-- New Password Confirmation --}}
                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        {!! Form::label('password_confirmation', 'New Password Confirmation', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <a href="{{ route('profile.index') }}" class="btn btn-default">Cancel</a>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="submit" class="btn btn-primary" value="Save" />
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection