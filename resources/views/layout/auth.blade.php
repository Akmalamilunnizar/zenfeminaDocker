<!DOCTYPE html>
<html lang="en" data-bs-theme="light">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ resources('sass/pages/app.css/') }}"/>

    <link rel="stylesheet" href="{{ resources('sass/pages/auth.css/') }}"/>

    @vite([
        "resources/sass/app.scss",
        "resources/sass/themes/dark/app-dark.scss",
        "resources/sass/pages/auth.scss"
        "resources/sass/pages/auth.css"
    ])
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
@vite('resources/js/initTheme.js')
<div id="auth">
    @yield('content')
</div>
</body>

</html>
