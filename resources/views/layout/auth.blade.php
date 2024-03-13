<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{asset('assets/scss/app.scss')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/themes/dark/app-dark.scss')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/pages/auth.scss')}}">
    <link rel="shortcut icon" href="{{asset('assets/static/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/static/images/logo/favicon.png')}}" type="image/png">
</head>

<body>
<script src="{{asset('assets/static/js/initTheme.js')}}"></script>
<div id="auth">
    @yield('content')
</div>
</body>
</html>
