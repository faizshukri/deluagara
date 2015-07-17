@extends('layouts.master')

@section('content')
    @inject('progress', 'App\Contracts\Progress')

    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Edit Profile</h2>
            {!! Form::model($user, ['route' => ['account.update'], 'class' => 'form-horizontal', 'files' => 'true' ]) !!}
                {!! Form::token() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Information
                            <span class="badge distribution-count">+{{ $progress->getPoint('about_me') }}</span>
                        </h3>
                    </div>
                    <div class="panel-body">

                        {{-- Name --}}
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            {!! Form::label('name', 'Name', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                            </div>
                        </div>

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

                        {{-- Phone --}}
                        <div class="form-group @if ($errors->has('phone')) has-error @endif">
                            {!! Form::label('phone', 'Phone', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
                            </div>
                        </div>

                        {{-- About Me --}}
                        <div class="form-group @if ($errors->has('about_me')) has-error @endif">
                            {!! Form::label('about_me', 'About Me', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::textarea('about_me', null, ['class'=>'form-control', 'rows' => 3, 'style' => 'resize: none;']) !!}
                                @if ($errors->has('about_me')) <p class="help-block">{{ $errors->first('about_me') }}</p> @endif
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div class="form-group @if ($errors->has('gender')) has-error @endif">
                            {!! Form::label('gender', 'Gender', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    {!! Form::radio('gender', 'male') !!} Male
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('gender', 'female') !!} Female
                                </label>
                                @if ($errors->has('gender')) <p class="help-block">{{ $errors->first('gender') }}</p> @endif
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-group @if ($errors->has('status')) has-error @endif">
                            {!! Form::label('status', 'Status', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">

                                @foreach( $statuses as $status )
                                    <label class="radio-inline">
                                        {!! Form::radio('status[id]', $status->id) !!} {{ $status->title }}
                                    </label>
                                @endforeach
                                @if ($errors->has('status')) <p class="help-block">{{ $errors->first('status') }}</p> @endif
                            </div>
                        </div>

                        {{-- Sponsor --}}
                        <div class="form-group @if ($errors->has('sponsor')) has-error @endif">
                            {!! Form::label('sponsor', 'Sponsor', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">

                                @foreach( $sponsors as $sponsor )
                                    <label class="radio-inline">
                                        {!! Form::radio('sponsor[id]', $sponsor->id) !!} {{ $sponsor->title }}
                                    </label>
                                @endforeach
                                @if ($errors->has('sponsor')) <p class="help-block">{{ $errors->first('sponsor') }}</p> @endif
                            </div>
                        </div>

                        {{-- Profile Image --}}
                        <div class="form-group">
                            {!! Form::label('profile_image', 'Profile Image', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::file('profile_image', ['class'=>'form-control']) !!}
                                <br/>
                                <img id="profile_image_preview" src="{{ $user->profile_image or 'http://www.gravatar.com/avatar/' . md5(strtolower(trim( $user->email ))) . '?d=monsterid&s=250' }}" style="width: 150px; border: 1px solid #ddd; padding: 2px; cursor: pointer;" />
                                <span class="badge distribution-count">+{{ $progress->getPoint('profile_image') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Address Information <span class="badge distribution-count">+{{ $progress->getPoint('address') }}</span></h3>
                    </div>
                    <div class="panel-body">

                        {{-- Street --}}
                        <div class="form-group @if ($errors->has('location.street')) has-error @endif">
                            {!! Form::label('location[street]', 'Street', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('location[street]', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('location.street')) <p class="help-block">{{ $errors->first('location.street') }}</p> @endif
                            </div>
                        </div>

                        {{-- Postcode --}}
                        <div class="form-group @if ($errors->has('location.postcode')) has-error @endif">
                            {!! Form::label('location[postcode]', 'Postcode', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('location[postcode]', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('location.postcode')) <p class="help-block">{{ $errors->first('location.postcode') }}</p> @endif
                            </div>
                        </div>

                        {{-- City --}}
                        <div class="form-group @if ($errors->has('location.city.id')) has-error @endif">
                            {!! Form::label('location[city][id]', 'City (e.g Manchester)', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('location[city][id]', null, ['class'=>'form-control']) !!}
                                {!! Form::hidden('location[city][name]') !!}
                                @if ($errors->has('location.city.id')) <p class="help-block">{{ $errors->first('location.city.id') }}</p> @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Social Media Information <span class="badge distribution-count">+{{ $progress->getPoint('url') }}</span></h3>
                    </div>
                    <div class="panel-body">

                        {{-- Website --}}
                        <div class="form-group @if ($errors->has('website')) has-error @endif">
                            {!! Form::label('website', 'Website', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('website', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('website')) <p class="help-block">{{ $errors->first('website') }}</p> @endif
                            </div>
                        </div>

                        {{-- Facebook URL --}}
                        <div class="form-group @if ($errors->has('facebook_url')) has-error @endif">
                            {!! Form::label('facebook_url', 'Facebook URL', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">http://facebook.com/</span>
                                    {!! Form::text('facebook_url', null, ['class'=>'form-control']) !!}
                                </div>
                                @if ($errors->has('facebook_url')) <p class="help-block">{{ $errors->first('facebook_url') }}</p> @endif
                            </div>
                        </div>

                        {{-- Twitter URL --}}
                        <div class="form-group @if ($errors->has('twitter_url')) has-error @endif">
                            {!! Form::label('twitter_url', 'Twitter URL', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">http://twitter.com/</span>
                                    {!! Form::text('twitter_url', null, ['class'=>'form-control']) !!}
                                </div>
                                @if ($errors->has('twitter_url')) <p class="help-block">{{ $errors->first('twitter_url') }}</p> @endif
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('account.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script>

        (function(){
            var select2Selector = $('[id="location[city][id]"]');

            select2Selector.select2({
                placeholder: "Select a city",
                allowClear: true,
                ajax: {
                    url: function(city){
                        return '/api/v1/cities/'+city;
                    },
                    results: function (data, page) {
                        return {
                            results: data
                        };
                    },
                    quietMillis: 250,
                    dataType: 'json',
                    cache: true
                },
                minimumInputLength: 3,
                initSelection: function (item, callback) {
                    var id = item.val();
                    var text = $('[name="location[city][name]"]').val();
                    var data = { id: id, text: text };
                    callback(data);
                }
            }).on('select2-selecting', function(val){
                $('[name="location[city][name]"]').val(val.choice.text);
            });

            $('#profile_image_preview').on('click', function(){
                $('#profile_image').trigger('click');
            });
        })();
    </script>
@endsection