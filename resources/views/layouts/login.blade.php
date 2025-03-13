<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fee Management - @yield('title', 'Default')</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('includes.login.head-assets')
</head>

<body class="{{ @$body_css_class }}">
    @yield('content')
    @include('includes.login.footer-assets')
    @stack('footer-assets')
</body>

</html>