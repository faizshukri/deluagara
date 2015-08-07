@extends('layouts.master')

@section('title', 'Home')

@section('map-front')
    @include('partials.map-front')
@endsection

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-sm-12" align="center">
            <h1>Katsitu is a public listing for Malaysian residing abroad</h1>
        </div>
        <p class="clearfix">&nbsp;</p>
        <div class="col-sm-12 features-wrapper">
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/map.png">
                        <h2>Map</h2>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/profile.png">
                        <h2>Profile</h2>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/people.png">
                        <h2>People</h2>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/messaging.png">
                        <h2>Messaging</h2>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/event.png">
                        <h2>Event</h2>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/accomodation.png">
                        <h2>Accomodation</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
