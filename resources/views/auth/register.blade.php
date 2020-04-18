<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="fonts/iconsmind/style.css" />
    <link rel="stylesheet" href="fonts/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>


<body class="show-spinner">
<div class="landing-page">
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
            <li class="nav-item mb-2">
                <a href="LandingPage.Blog.html">BLOG</a>
            </li>
            <li class="nav-item">
                <div class="separator"></div>
            </li>
            <li class="nav-item mt-2">
                <a href="LandingPage.Auth.Login.html">SIGN IN</a>
            </li>
            <li class="nav-item">
                <a href="LandingPage.Auth.Register.html">SIGN UP</a>
            </li>
        </ul>
    </div>
    <div class="main-container">
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
                    <li class="nav-item">
                        <a href="LandingPage.Blog.html">BLOG</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a href="/login">SIGN IN</a>
                    </li>
                    <li class="nav-item pl-2">
                        <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="/register">SIGN
                            UP</a>
                    </li>
                </ul>
                <a href="#" class="mobile-menu-button">
                    <i class="simple-icon-menu"></i>
                </a>
            </div>
        </nav>
        <div class="content-container">
            <div class="section home subpage-long">
                <div class="container">
                    <div class="row home-row mb-0">
                        <div class="col-12 col-lg-6 col-xl-4 col-md-12">
                            <div class="home-text">
                                <div class="display-1">
                                    Register
                                </div>
                                <p class="white mb-5">
                                    Please use this form to register.
                                    If you are already a member, please <a href="/login" class="white-underline-link">login</a>.
                                </p>
                                <form class="dark-background" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <label class="form-group has-top-label">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <span>NAME</span>
                                    </label>
                                    @error('name')
                                    <span role="alert" style="color: white">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-group has-top-label">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        <span>E-MAIL</span>
                                    </label>
                                    @error('email')
                                    <span role="alert" style="color: white">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label class="form-group has-top-label">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <span>PASSWORD</span>
                                    </label>
                                    @error('password')
                                    <span role="alert" style="color: white">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label class="form-group has-top-label">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <span>CONFIRM PASSWORD</span>
                                    </label>

                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="role" value="2" id="option1" checked> Hire Worker
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="role" value="3" id="option2"> Earn Money
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="role" value="4" id="option3"> Consultant
                                        </label>
                                    </div>

                                    <div>
                                        <button class="btn btn-outline-semi-light btn-xl mt-4" type="submit">REGISTER</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/vendor/jquery-3.3.1.min.js"></script>
<script src="js/vendor/bootstrap.bundle.min.js"></script>
<script src="js/vendor/owl.carousel.min.js"></script>
<script src="js/vendor/jquery.barrating.min.js"></script>
<script src="js/vendor/jquery.barrating.min.js"></script>
<script src="js/vendor/landing-page/headroom.min.js"></script>
<script src="js/vendor/landing-page/jQuery.headroom.js"></script>
<script src="js/vendor/landing-page/jquery.scrollTo.min.js"></script>
<script src="js/dore.scripts.landingpage.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
