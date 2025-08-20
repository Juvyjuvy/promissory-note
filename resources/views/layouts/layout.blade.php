<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    <title>@yield('title') | MY.SPC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        @vite('resources/css/app.css')

</head>

<body class="bg-gray-100 font-sans">
    @yield('content')
</body>
</html>
