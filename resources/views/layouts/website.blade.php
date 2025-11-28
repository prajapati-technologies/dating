<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ setting('site_name') ?? 'Dating App' }}</title>
    <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

</body>
</html>
