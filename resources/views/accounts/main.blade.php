@extends('layouts.master')

@section('title', 'My Account')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
            <div class="panel-wrapper">
                <div class="row">
                    <div class="col-xs-3">
                        <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" style="width: 100%; padding: 3px; border: 1px solid #ddd;"/>
                    </div>
                    <div class="col-xs-9">
                        <h1 style="font-weight: normal; margin-bottom: 0px; margin-top: 0px;">{{ $user->name }}</h1>
                        <h3 style="margin-top: 0px;">{{ $user->location->city->name }}</h3>

                        <p><i>{{ $user->about_me }}</i></p>
                        <p style="font-size: 1.7em;">
                            @if($user->facebook_url)
                                <a href="{{ $user->facebook_url }}" target="_blank"><i class="fa fa-facebook-official" style="color: #45609d;"></i></a>&nbsp;
                            @endif
                            @if($user->twitter_url)
                                <a href="{{ $user->twitter_url }}" target="_blank"><i class="fa fa-twitter" style="color: #22c7ff;"></i></a>&nbsp;
                            @endif
                            @if($user->website)
                                <a href="{{ $user->website }}" target="_blank"><i class="fa fa-external-link"></i></a>
                            @endif
                        </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-12">
                        @include('partials.map-account')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
