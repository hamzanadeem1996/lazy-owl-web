<style>
    #neon-text {
        color: #922C88;
        text-align: center;
        /* text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #0073e6, 0 0 20px #0073e6, 0 0 25px #0073e6, 0 0 30px #0073e6, 0 0 35px #0073e6; */
    }
</style>
<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>
    </div>


    <a class="navbar-logo" href="/home">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="position-relative d-none d-sm-inline-block">
                
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-Equalizer d-block"></i>
                        <span>Settings</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-MaleFemale d-block"></i>
                        <span>Users</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-Puzzle d-block"></i>
                        <span>Components</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-Bar-Chart d-block"></i>
                        <span>Profits</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-File-Chart d-block"></i>
                        <span>Surveys</span>
                    </a>

                    <a href="#" class="icon-menu-item">
                        <i class="iconsmind-Suitcase d-block"></i>
                        <span>Tasks</span>
                    </a>

                </div>
            </div>

            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span class="count">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 scroll position-absolute" id="notificationDropdown">

                    <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                        <a href="#">
                            <img src="{{asset('img/profile-pic-l-2.jpg')}}" alt="Notification Image" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                        </a>
                        <div class="pl-3 pr-2">
                            <a href="#">
                                <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                            </a>
                        </div>
                    </div>   
                </div>
            </div>
        </div>

        <div class="position-relative user d-inline-block">
            <button class=" header-icon btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <span class="name">{{Auth::user()->name}}</span>
                <span>
                    @if(isset(Auth::user()->image))
                        <img src="{{asset('images/user/dummy.png' ) }}" alt="Profile Picture">
                    @else
                        <img src="{{asset('images/user/dummy.png' ) }}" alt="Profile Picture">
                    @endif
                    </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <h5 class="dropdown-item" id="neon-text">${{Auth::user()->wallet->amount}}</h5>
                <a class="dropdown-item" href="#">Account</a>
                <a class="dropdown-item" href="/admin/logout">Sign out</a>
            </div>
        </div>
    </div>
</nav>
