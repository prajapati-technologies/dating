<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $settings->site_name ?? 'My Dating App' }}</title>
    <link rel="icon" href="{{ asset('storage/' . ($settings->favicon ?? 'default/favicon.png')) }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-white text-gray-700">

    <!-- HEADER -->
    <header class="bg-pink-600 text-white py-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/' . ($settings->logo ?? 'default/logo.png')) }}" 
                     class="h-10 w-auto" alt="Logo">
                <h1 class="text-xl font-bold">{{ $settings->site_name ?? 'Dating App' }}</h1>
            </div>

            <!-- Navigation -->
            <nav class="space-x-6 hidden md:block">
                <a href="/" class="hover:text-gray-200">Home</a>
                <a href="/about" class="hover:text-gray-200">About</a>
                <a href="/features" class="hover:text-gray-200">Features</a>
                <a href="/pricing" class="hover:text-gray-200">Pricing</a>
                <a href="/contact" class="hover:text-gray-200">Contact</a>
            </nav>

            <!-- Buttons -->
            <div class="flex space-x-3">
                <a href="/login" class="bg-white text-pink-600 px-4 py-2 rounded-lg">Login</a>
                <a href="/register" class="bg-purple-700 text-white px-4 py-2 rounded-lg">Sign Up</a>
            </div>
        </div>
    </header>

    <!-- PAGE CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white mt-16 py-10">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">

            <div>
                <img src="{{ asset('storage/' . ($settings->logo ?? 'default/logo.png')) }}"
                     class="h-12 mb-3">
                <p class="text-gray-300 text-sm">{{ $settings->tagline ?? 'Find your perfect match ❤️' }}</p>
            </div>

            <div>
                <h3 class="font-bold mb-2 text-lg">Company</h3>
                <ul class="text-gray-300 space-y-2">
                    <li><a href="/about">About</a></li>
                    <li><a href="/features">Features</a></li>
                    <li><a href="/pricing">Pricing</a></li>
                    <li><a href="/blog">Blog</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-2 text-lg">Support</h3>
                <ul class="text-gray-300 space-y-2">
                    <li><a href="/help">Help Center</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href="/privacy">Privacy Policy</a></li>
                    <li><a href="/terms">Terms of Service</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-2 text-lg">Contact</h3>
                <p class="text-gray-300">{{ $settings->email }}</p>
                <p class="text-gray-300">{{ $settings->phone }}</p>
                <p class="text-gray-300">{{ $settings->address }}</p>
            </div>

        </div>

        <p class="text-center mt-10 text-gray-400 text-sm">
            {{ $settings->footer_text ?? '© Copyright Dating App' }}
        </p>
    </footer>

</body>
</html>
