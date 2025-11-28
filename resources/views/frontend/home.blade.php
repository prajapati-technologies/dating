<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->app_name ?? 'LoveMatch' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800">

    <!-- HERO SECTION -->
    <section class="min-h-screen bg-gradient-to-br from-pink-500 to-purple-600 flex items-center px-6 md:px-20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">

            <!-- LEFT CONTENT -->
            <div class="text-white space-y-6">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
                    Find Your <span class="text-yellow-300">Perfect Match</span> ❤️
                </h1>

                <p class="text-lg opacity-90">
                    A modern dating experience built for real connections.  
                    Swipe. Match. Chat. Meet.  
                </p>

                <div class="flex gap-4 mt-6">
                    <a href="{{ route('register') }}"
                       class="bg-white text-pink-600 px-6 py-3 rounded-xl font-bold shadow hover:bg-gray-100">
                        Create Account
                    </a>

                    <a href="{{ route('login') }}"
                       class="bg-pink-700/40 text-white px-6 py-3 rounded-xl font-bold backdrop-blur border border-white/20">
                        Login
                    </a>
                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="relative">
                <img src="/images/landing-hero.png" class="w-full drop-shadow-2xl rounded-3xl">
                <div class="absolute -bottom-4 -right-4 bg-white text-pink-600 px-4 py-2 rounded-xl shadow-lg font-bold">
                    ❤️ 50,000+ Active Users
                </div>
            </div>

        </div>
    </section>


    <!-- FEATURES SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">

            <h2 class="text-4xl font-extrabold mb-10">Why Choose <span class="text-pink-600">LoveMatch?</span></h2>

            <div class="grid md:grid-cols-3 gap-10">

                <div class="p-8 shadow rounded-2xl border hover:shadow-lg transition">
                    <div class="text-5xl mb-4">🔥</div>
                    <h3 class="text-xl font-bold mb-2">Smart Matching</h3>
                    <p class="text-gray-600">AI-based matching helps you find compatible partners.</p>
                </div>

                <div class="p-8 shadow rounded-2xl border hover:shadow-lg transition">
                    <div class="text-5xl mb-4">🔒</div>
                    <h3 class="text-xl font-bold mb-2">Safe & Verified</h3>
                    <p class="text-gray-600">Every profile is human-checked for your safety.</p>
                </div>

                <div class="p-8 shadow rounded-2xl border hover:shadow-lg transition">
                    <div class="text-5xl mb-4">💬</div>
                    <h3 class="text-xl font-bold mb-2">Instant Chat</h3>
                    <p class="text-gray-600">Real-time messaging to connect instantly.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- CTA SECTION -->
    <section class="py-20 bg-gradient-to-r from-purple-600 to-pink-600 text-center text-white">
        <h2 class="text-4xl font-extrabold mb-6">Ready to Start Your Journey?</h2>
        <p class="text-lg mb-8 opacity-95">Join thousands who found meaningful connections.</p>

        <a href="{{ route('register') }}"
            class="bg-white text-pink-600 px-8 py-4 rounded-2xl font-bold text-xl shadow-xl hover:bg-gray-100">
            Join LoveMatch Now ❤️
        </a>
    </section>


    <!-- FOOTER -->
    <footer class="py-10 bg-gray-900 text-center text-gray-400">
        <p>&copy; {{ date('Y') }} {{ $settings->app_name ?? 'LoveMatch' }} — All Rights Reserved.</p>
    </footer>

</body>
</html>
