<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>@yield('title')</title>
    @include('includes.home.header')

</head>

<body class="show-spinner">
    <div class="landing-page">
        @include('includes.home.mobile-navbar')
        <div class="main-container">
            @include('includes.home.desktop-navbar')
            @yield('content')
            @include('includes.home.footer_content')
        </div>
    </div>
@include('includes.home.footer')
</body>
</html>

