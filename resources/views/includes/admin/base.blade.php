<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/ico" />

    <title> @yield('title') </title>
    @include('includes.admin.header')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('includes.admin.sidebar')
        @include('includes.admin.navbar')
        <div class="right_col" role="main">
            @yield('content')
        </div>
    </div>
</div>
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
@include('includes.admin.footer')
</body>
</html>
