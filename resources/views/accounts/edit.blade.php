@extends('layouts.master')

@section('content')
    @inject('progress', 'Katsitu\Contracts\Progress')

    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Edit Profile</h2>
            {!! Form::model($user, ['route' => ['account.update'], 'class' => 'form-horizontal', 'files' => 'true' ]) !!}
                {!! Form::token() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Information
                            <span class="badge distribution-count">+{{ $progress->getPointPercentage('about_me') }}</span>
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

                        {{-- Profile Image --}}
                        <div class="form-group @if ($errors->has('profile_image')) has-error @endif">
                            {!! Form::label('profile_image', 'Profile Image', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::file('profile_image', ['class'=>'form-control']) !!}
                                <br/>
                                <img id="profile_image_preview" src="{{ $user->profile_image or '//www.gravatar.com/avatar/' . md5(strtolower(trim( $user->email ))) . '?d=monsterid&s=250' }}" style="width: 150px; height: 150px; border: 1px solid #ddd; padding: 2px; cursor: pointer;" />
                                <span class="badge distribution-count">+{{ $progress->getPointPercentage('profile_image') }}</span>
                                @if ($errors->has('profile_image')) <p class="help-block">{{ $errors->first('profile_image') }}</p> @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Education / Working Information <span class="badge distribution-count">+{{ $progress->getPointPercentage('education') }}</span></h3>
                    </div>
                    <div class="panel-body">

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

                        {{-- Course / Work --}}
                        <div class="form-group @if ($errors->has('course_work')) has-error @endif">
                            {!! Form::label('course_work', 'Course / Work', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('course_work', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('course_work')) <p class="help-block">{{ $errors->first('course_work') }}</p> @endif
                            </div>
                        </div>

                        {{-- End Date --}}
                        <div class="form-group @if ($errors->has('end_date')) has-error @endif">
                            {!! Form::label('end_date', 'End Date', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::date('end_date', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('end_date')) <p class="help-block">{{ $errors->first('end_date') }}</p> @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Address Information <span class="badge distribution-count">+{{ $progress->getPointPercentage('address') }}</span></h3>
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
                                {!! Form::select('location[city][id]', [], null, ['class'=>'form-control']) !!}
                                @if ($errors->has('location.city.id')) <p class="help-block">{{ $errors->first('location.city.id') }}</p> @endif
                            </div>
                        </div>

                        {{-- Map --}}
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                @include('partials/map-edit')
                                {!! Form::hidden('location[latitude]') !!}
                                {!! Form::hidden('location[longitude]') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Social Media Information <span class="badge distribution-count">+{{ $progress->getPointPercentage('url') }}</span></h3>
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

            var $element = select2Selector.select2({
                theme: "bootstrap",
                placeholder: "Select a city",
                allowClear: true,
                ajax: {
                    url: function(city){
                        return '/api/v1/cities/' + city.term;
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                    data: false,
                    delay: 250,
                    dataType: 'json',
                    cache: true
                },
                minimumInputLength: 3,
            });

            // Check if city id is set. If so, auto populate it
            var city_id = "{{ $city_id or '' }}";

            if(city_id) {

                var $request = $.ajax({
                    url: '/api/v1/city/' + city_id
                });
                $request.then(function (data) {
                    var option = new Option(data.text, data.id, true, true);
                    $element.append(option);
                    $element.trigger('change', [ true ]);
                });
            }

            // Make image preview clickable
            $('#profile_image_preview').on('click', function(){
                $('#profile_image').trigger('click');
            });

            // Preview image before it's been uploaded
            $("#profile_image").change(function(){
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile_image_preview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Toggle sponsor when user status changed to working
            var working_id = 3;

            var toggleSponsor = function(){
                if($('input[name="status[id]"]:checked').val() == working_id){
                    $('input[name="sponsor[id]"]').prop('disabled', true);
                    $('input[name="sponsor[id]"]').closest('.form-group').hide();
                } else {
                    $('input[name="sponsor[id]"]').prop('disabled', false);
                    $('input[name="sponsor[id]"]').closest('.form-group').show();
                }
            };

            // Start toggleSponsr for first time
            toggleSponsor();

            // Hide sponsor if working is selected
            $('input[name="status[id]"]').on('change', function(){
                console.log('status change ', $('input[name="status[id]"]:checked').val());
                toggleSponsor();
            });

        })();
    </script>
@endsection