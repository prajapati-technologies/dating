<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->site_name ?? config('app.name','Dating') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-800">

    @include('partials.header')

    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
