@extends('layouts/master')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-3">
            <form method="get" action="{{ route('people.index') }}">

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $request['name'] or '' }}">
                </div>

                {{-- City --}}
                <div class="form-group">
                    <label for="city">City (e.g Manchester)</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $request['city'] or '' }}" data-option="{{ $city }}">
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

                {{-- Scholarship --}}
                <div class="form-group">
                    <label for="scholarship">Scholarship</label>
                    <select type="text" class="form-control" id="scholarship" name="scholarship">
                        <option value="">Select scholarship</option>
                        @foreach($scholarship as $scholar)
                            <option value="{{ $scholar->id }}" {{ isset($request['scholarship']) && $request['scholarship'] == $scholar->id ? 'selected' : '' }}>{{ $scholar->title }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">Search</button>
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            </form>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    @include('partials/map-result')
                    <ul>
                        @foreach($users as $user)
                            <li>{{ $user->name }} - {{ $user->location->city->name }}</li>
                        @endforeach
                    </ul>
                    @if(sizeof($users) == 0)
                        <h2>No result found</h2>
                    @endif
                </div>
                {!! $users->appends($request)->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#city').select2({
            placeholder: "Select a city",
            allowClear: true,
            ajax: {
                url: function(city){
                    console.log(city);
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
                var text = item.data('option');
                var data = { id: id, text: text };
                callback(data);
            }
        });
    </script>
@endsection
