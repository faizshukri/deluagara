@extends('email.basic')

@section('content')
    <table>
        <tr>
            <td>
                <h3>Hi, {{ $user->name }}</h3>
                <p class="lead">Thanks for creating an account with the verification demo app.</p>
                <p>Please follow the link below to verify your email address.</p>
                <p class="callout"><a href="{{ url('register/verify/' . $user->confirmation_code) }}">{{ url('register/verify/' . $user->confirmation_code) }}</a></p>
            </td>
        </tr>
    </table>
@endsection