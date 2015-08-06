<nav class="navbar navbar-inverse">
    <div class="container-fluid" style="height: 100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" style="padding: 5px 15px;"><img src="/images/logo.png" style="height: 100%;"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                @if ( $currentUser )
                    <li class="{{ set_active('people') }}"><a href="{{ route('people.index') }}">People</a></li>
                    {{--<li class="{{ set_active('event') }}"><a href="{{ route('event.index') }}">Event</a></li>--}}
                    {{--<li class="{{ set_active('host') }}"><a href="#">Accomodation</a></li>--}}
                    {{--<li class="{{ set_active('mybay') }}"><a href="#">MyBay</a></li>--}}
                    {{--<li class="{{ set_active('blog') }}"><a href="#">Blog</a></li>--}}
                    {{--<li class="{{ set_active('Group') }}"><a href="#">Group</a></li>--}}
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if ( $currentUser )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $currentUser->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile', $currentUser->username) }}">My Profile</a></li>
                            <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
                            <li><a href="{{ route('account.edit') }}">Edit Account</a></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="{{ set_active('login') }}"><a href="{{ route('auth.login') }}">Login</a></li>
                    <li class="{{ set_active('register') }}"><a href="{{ route('auth.register') }}">Register</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>