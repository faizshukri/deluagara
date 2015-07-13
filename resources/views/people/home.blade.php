@extends('layouts/master')

@section('content')
    <p class="clearfix">&nbsp;</p>
    <div class="row">
        <div class="col-md-3">
            <form action="">

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                {{-- City --}}
                <div class="form-group">
                    <label for="city">City (e.g Manchester)</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City (e.g Manchester)">
                </div>

                {{-- Gender --}}
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select type="text" class="form-control" id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label>Status</label>
                    @foreach($statuses as $status)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status[]" value="{{ $status->id }}"> {{ $status->title }}
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
                            <option value="{{ $scholar->id }}">{{ $scholar->title }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">Search</button>

            </form>
        </div>
        <div class="col-md-9">
            content
        </div>
    </div>
@endsection