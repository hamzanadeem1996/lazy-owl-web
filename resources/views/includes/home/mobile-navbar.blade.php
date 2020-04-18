<div class="mobile-menu">
    <a href="LandingPage.Home.html" class="logo-mobile">
        <span></span>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="LandingPage.Features.html">FEATURES</a>
        </li>
        <li class="nav-item">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <li class="nav-item">
            <div class="separator"></div>
        </li>
        <li class="nav-item mt-2">
            <a href="/login">SIGN IN</a>
        </li>
        <li class="nav-item">
            <a href="/register">SIGN UP</a>
        </li>
    </ul>
</div>
