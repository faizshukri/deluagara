@extends('layouts.master')

@section('title', 'Home')

@section('meta')
    <meta property="og:title" content="Katsitu.Com Homepage" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Katsitu is a public listing website for Malaysian community residing in United Kingdom." />
    <meta property="og:image" content="{{ url('/images/map_screenshot.jpg') }}" />
@endsection

@section('map-front')
    @include('partials.map-front')
@endsection

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-sm-12" align="center">
            <h1>Katsitu is a public listing website for Malaysian community residing
                <span style="text-decoration: line-through;">abroad.</span> in <span style="font-weight: normal;">United Kingdom</span>.</h1>
        </div>
        <p class="clearfix">&nbsp;</p>
        <div class="col-sm-12 features-wrapper">
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/map.png">
                        <h2>Map</h2>
                        <p>Get to know Malaysian population around UK in bird's eye view.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/profile.png">
                        <h2>Profile</h2>
                        <p>A public, clean and attractive profile page for every Katsitu members.</p>
                    </div>
                </div>
                <p class="clearfix xs-separator"></p>
                <div class="col-sm-4 col-xs-6">
                    <div align="center">
                        <img src="/images/features/people.png">
                        <h2>People</h2>
                        <p>Search Malaysian living in UK easily based on the criterias provided.</p>
                    </div>
                </div>
                <p class="clearfix sm-separator"></p>
                <div class="col-sm-4 col-xs-6">
                    <div align="center" class="comingsoon">
                        <div class="label label-warning">Coming Soon</div>
                        <img src="/images/features/messaging.png">
                        <h2>Messaging</h2>
                        <p>Interact with people through Katsitu's secure Private Message.</p>
                    </div>
                </div>
                <p class="clearfix xs-separator"></p>
                <div class="col-sm-4 col-xs-6">
                    <div align="center"class="comingsoon">
                        <div class="label label-warning">Coming Soon</div>
                        <img src="/images/features/event.png">
                        <h2>Event</h2>
                        <p>Keep updated with Malaysian's event that happened around UK.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div align="center"class="comingsoon">
                        <div class="label label-warning">Coming Soon</div>
                        <img src="/images/features/accomodation.png">
                        <h2>Accomodation</h2>
                        <p>Discover and pick Malaysian's hosts easily or become one.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
