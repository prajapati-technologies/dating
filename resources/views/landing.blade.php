<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'Dating App' }}</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-pink-500 to-purple-700 text-white">

    <!-- HEADER -->
    <header class="px-6 py-4 flex justify-between items-center backdrop-blur-md bg-white/10 shadow-lg">
        <div class="flex items-center gap-3">
            @if(!empty($settings->logo))
                <img src="{{ asset('storage/' . $settings->logo) }}" class="h-12 w-12 rounded-full shadow">
            @else
                <div class="h-12 w-12 bg-white/20 rounded-full flex items-center justify-center text-xl font-bold">💗</div>
            @endif

            <h1 class="text-2xl font-extrabold">
                {{ $settings->site_name ?? 'LoveConnect' }}
            </h1>
        </div>

        <nav class="flex items-center gap-6 text-white/90 font-semibold">
            <a href="#features" class="hover:text-white">Features</a>
            <a href="#about" class="hover:text-white">About</a>
            <a href="{{ route('login') }}" class="hover:text-white">Login</a>

            <a href="{{ route('register') }}"
               class="bg-white text-pink-600 px-4 py-2 rounded-xl shadow font-bold hover:bg-gray-100">
                Get Started
            </a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="px-6 md:px-20 py-24 text-center">
        <h2 class="text-4xl md:text-6xl font-extrabold leading-tight drop-shadow-lg">
            {{ $settings->tagline ?? 'Find Your Perfect Match Today ❤️' }}
        </h2>

        <p class="text-white/80 mt-4 text-lg md:text-xl max-w-xl mx-auto">
            The most premium AI-powered dating experience.  
            Swipe. Match. Chat. Fall in love. 💞
        </p>

        <a href="{{ route('register') }}"
           class="mt-8 inline-block bg-white text-pink-600 px-8 py-4 text-xl rounded-2xl shadow-lg font-bold hover:bg-gray-100 transition">
            Create Your Profile ❤️
        </a>
    </section>

    <!-- FEATURES -->
    <section id="features" class="px-6 md:px-20 py-20 bg-white text-gray-800 rounded-t-3xl">
        <h3 class="text-3xl font-extrabold text-center mb-12">🔥 Why Choose Us?</h3>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="bg-white p-6 rounded-2xl shadow-xl text-center border">
                <div class="text-4xl mb-3">💖</div>
                <h4 class="text-xl font-bold mb-2">Smart Matching</h4>
                <p class="text-gray-600">AI-powered algorithm finds your perfect match based on interests & behavior.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl text-center border">
                <div class="text-4xl mb-3">🔥</div>
                <h4 class="text-xl font-bold mb-2">Tinder-Style Swipe</h4>
                <p class="text-gray-600">Swipe left or right with smooth premium animations.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl text-center border">
                <div class="text-4xl mb-3">🔐</div>
                <h4 class="text-xl font-bold mb-2">Safe & Secure</h4>
                <p class="text-gray-600">We protect your privacy with top-level security & encrypted chat.</p>
            </div>

        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="px-6 md:px-20 py-20 text-center">
        <h3 class="text-3xl font-extrabold mb-6">About Us</h3>
        <p class="max-w-3xl mx-auto text-white/80 text-lg">
            {{ $settings->footer_text ?? 'We help people connect, match, chat, and fall in love. Join thousands of users who have already found meaningful relationships.' }}
        </p>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black/20 backdrop-blur-md py-6 text-center text-white/70">
        {{ $settings->footer_text ?? '© 2025 LoveConnect. All Rights Reserved.' }}
    </footer>

</body>
</html>
