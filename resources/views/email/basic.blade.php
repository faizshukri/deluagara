@extends('email.layout')

@section('email_body')
    <!-- BODY -->
    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container" bgcolor="#FFFFFF">

                <div class="content">
                    @yield('content')
                </div><!-- /content -->

            </td>
            <td></td>
        </tr>
    </table><!-- /BODY -->
@endsection