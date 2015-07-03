@extends('layouts.master')

@section('title', 'My Account')

@section('content')
    <h1>My Profile</h1>
    <hr/>
    <h2>{{ $user->name }}</h2>
@endsection
