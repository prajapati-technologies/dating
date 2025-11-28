<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $settings->site_name ?? 'My Dating App' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-md py-4 px-6">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold text-pink-600">
                {{ $settings->site_name ?? 'Dating App' }}
            </h1>

            <nav class="flex gap-6 text-gray-700">
                <a href="/" class="hover:text-pink-600">Home</a>
                <a href="/browse" class="hover:text-pink-600">Browse</a>
                <a href="/contact" class="hover:text-pink-600">Contact</a>
            </nav>
        </div>
    </header>

    @yield('content')

</body>
</html>
