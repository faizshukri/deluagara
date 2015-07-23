@extends('layouts/master')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-sm-3">
            <div class="panel-wrapper">

                <form method="get" action="{{ route('people.index') }}">

                    {{-- Name --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $request['name'] or '' }}">
                    </div>

                    {{-- City --}}
                    <div class="form-group">
                        <label for="city">City (e.g Manchester)</label>
                        <select name="city" id="city" class="form-control"></select>
                    </div>

                    {{-- Gender --}}
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select type="text" class="form-control" id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="male" {{ isset($request['gender']) && $request['gender'] == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ isset($request['gender']) && $request['gender'] == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        @foreach($statuses as $status)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status[]" value="{{ $status->id }}" {{ isset($request['status']) && in_array( $status->id, $request['status']  ) ? 'checked' : '' }}>
                                        {{ $status->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sponsor --}}
                    <div class="form-group">
                        <label for="sponsor">Sponsor</label>
                        <select type="text" class="form-control" id="sponsor" name="sponsor">
                            <option value="">Select sponsor</option>
                            @foreach($sponsors as $sponsor)
                                <option value="{{ $sponsor->id }}" {{ isset($request['sponsor']) && $request['sponsor'] == $sponsor->id ? 'selected' : '' }}>{{ $sponsor->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                </form>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        @include('partials/map-result')
                    </div>
                </div>
                <p class="clearfix">&nbsp;</p>
                @foreach($users as $i => $user2)
                    @if($i%2 == 0)
                        <div class="row">
                            @foreach($users->slice($i, 2) as $j => $user)
                                <div class="col-sm-6" style="padding-top: 10px; padding-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{ $user->profile_image or 'http://www.gravatar.com/avatar/' . md5(strtolower(trim( $user->email ))) . '?d=monsterid&s=100' }}" style="width: 100px; height: 100px;" alt=""/>
                                        </div>
                                        <div class="col-sm-9">
                                            <div style="font-size: 1.2em;"><a href="{{ url($user->username) }}">{{ $user->name }}</a> <i style="" class="fa {{ $user->gender == "" ? ('fa-circle-thin') : ( $user->gender == 'male' ? 'fa-mars' : 'fa-venus' )}}"></i></div>

                                            @if($user->status)
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa {{ $user->status->title == 'Working' ? 'fa-briefcase' : 'fa-graduation-cap' }}"></i>
                                                </div>
                                                <div class="col-xs-10" style="font-size: 0.9em;">
                                                    {{ $user->status->title }} {{ $user->status->title == 'Working' ? "at" : "in" }} {{ $user->course_work }}
                                                </div>
                                            </div>
                                            @endif
                                            @if($user->sponsor)
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-building"></i>
                                                </div>
                                                <div class="col-xs-10" style="font-size: 0.9em;">
                                                    {{ $user->sponsor->title }}
                                                </div>
                                            </div>
                                            @endif
                                            @if($user->location && $user->location->city)
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="col-xs-10" style="font-size: 0.9em; font-style: italic">
                                                    {{ $user->location->city->name or '' }}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
                @if(sizeof($users) == 0)
                    <div class="col-sm-12"><h2>No result found</h2></div>
                @endif

            </div>
            <div class="row">
                <div class="col-sm-12" align="center">
                    {!! $users->appends($request)->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $element = $('#city').select2({
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
        var city_id = "{{ $request['city'] or '' }}";

        if(city_id) {

            var $request = $.ajax({
                url: '/api/v1/city/' + city_id
            });
            $request.then(function (data) {
                var option = new Option(data.text, data.id, true, true);
                $element.append(option);
                $element.trigger('change');
            });
        }

    </script>
@endsection
