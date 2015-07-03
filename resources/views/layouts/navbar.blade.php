<nav class="navbar navbar-inverse">
    <div class="container-fluid" style="height: 100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">People</a></li>
                <li><a href="#">Host</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if ($user )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $user->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('account.index') }}">My Account</a></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('auth.login') }}">Login</a></li>
                    <li><a href="{{ route('auth.register') }}">Register</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>