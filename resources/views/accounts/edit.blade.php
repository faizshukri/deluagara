@extends('layouts.master')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Edit Profile</h2>
            <form class="form-horizontal" action="{{ route('account.update', $user->id) }}" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Information</h3>
                    </div>
                    <div class="panel-body">

                        {{-- Name --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" id="name" value="{{ $user->name or '' }}"/>
                            </div>
                        </div>

                        {{-- Username --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="username">Username</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="username" id="username" value="{{ $user->username or '' }}"/>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" id="email" value="{{ $user->email or '' }}"/>
                            </div>
                        </div>

                        {{-- About Me --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="about_me">About Me</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="about_me" id="about_me" rows="3" style="resize: none;">{{ $user->about_me or '' }}</textarea>
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gender">Gender</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}> Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}> Female
                                </label>
                            </div>
                        </div>

                        {{-- Status --}}
                        @inject('statuses', 'App\UserStatus')
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="status">Status</label>
                            <div class="col-sm-10">
                                @foreach( $statuses->all() as $status )
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="{{ $status->id }}" {{ $user->user_status_id == $status->id ? 'checked' : '' }}> {{ $status->title }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Sponsor --}}
                        @inject('sponsors', 'App\Sponsor')
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="sponsor">Sponsor</label>
                            <div class="col-sm-10">
                                @foreach( $sponsors->all() as $sponsor )
                                    <label class="radio-inline">
                                        <input type="radio" name="sponsor" value="{{ $sponsor->id }}" {{ $user->sponsor_id == $sponsor->id ? 'checked' : '' }}> {{ $sponsor->title }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Profile Image --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="profile_image">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="profile_image" id="profile_image">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Address Information</h3>
                    </div>
                    <div class="panel-body">

                        {{-- Address --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="location.address">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="location.address" id="location.address" value="{{ $user->location->address or '' }}"/>
                            </div>
                        </div>

                        {{-- Postcode --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="location.postcode">Postcode</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="location.postcode" id="location.postcode" value="{{ $user->location->postcode or '' }}"/>
                            </div>
                        </div>

                        {{-- City --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="city">City (e.g Manchester)</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="city" id="city" value="{{ $user->location->city->id or '' }}" data-option="{{ $user->location->city->name or '' }}">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Social Media Information</h3>
                    </div>
                    <div class="panel-body">

                        {{-- Website --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="website">Website</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="website" id="website" value="{{ $user->website or '' }}"/>
                            </div>
                        </div>

                        {{-- Facebook URL --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="facebook_url">Facebook URL</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="facebook_url" id="facebook_url" value="{{ $user->facebook_url or '' }}"/>
                            </div>
                        </div>

                        {{-- Twitter URL --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="twitter_url">Twitter URL</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="twitter_url" id="twitter_url" value="{{ $user->twitter_url or '' }}"/>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('account.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </div>
                </div>
            </form>
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