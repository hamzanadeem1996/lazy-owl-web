<nav class="landing-page-nav">
    <div class="container d-flex align-items-center justify-content-between">
        <a class="navbar-logo pull-left" href="LandingPage.Home.html">
            <span class="white"></span>
            <span class="dark"></span>
        </a>
        <ul class="navbar-nav d-none d-lg-flex flex-row">
            <li class="nav-item">
                <a href="LandingPage.Features.html">FEATURES</a>
            </li>
            <li class="nav-item ">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        LEARN
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="LandingPage.Docs.html">DOCS</a>
                        <a class="dropdown-item" href="LandingPage.Videos.html">VIDEOS</a>
                        <a class="dropdown-item" href="LandingPage.Contact.html">HELP</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="LandingPage.Prices.html">PRICING</a>
            </li>
            
            @if (Auth::user())
                <li class="nav-item">
                    <a href="/active/tasks">Explore Tasks</a>
                </li>        
            @endif
            

            @if(Auth::user())
            <li class="nav-item">
                <a class="btn btn-outline-semi-light btn-sm" href="/login">DASHBOARD</a>
            </li>
                <li class="nav-item">
                    <a class="btn btn-outline-semi-light btn-sm" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="/login">SIGN IN</a>
                </li>
                <li class="nav-item pl-2">
                    <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="/register">SIGN UP</a>
                </li>
            @endif
        </ul>
        <a href="#" class="mobile-menu-button">
            <i class="simple-icon-menu"></i>
        </a>
    </div>
</nav>
