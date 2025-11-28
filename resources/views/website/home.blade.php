@extends('layouts.website')

@section('content')

<!-- HERO SECTION -->
<section class="bg-gradient-to-br from-pink-500 to-purple-700 text-white py-20">
    <div class="max-w-6xl mx-auto text-center px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">
            Find Your Perfect Match ❤️
        </h1>
        <p class="text-lg md:text-xl opacity-90 mb-8">
            Join thousands of users finding love, friendship, and meaningful connections.
        </p>
        <a href="/register" class="bg-white text-pink-600 px-8 py-4 rounded-full text-xl font-bold shadow-lg hover:bg-gray-100">
            Get Started Free
        </a>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 px-6">

        <div class="p-6 bg-pink-50 rounded-2xl shadow text-center">
            <div class="text-4xl mb-4">🔥</div>
            <h3 class="text-xl font-bold mb-2">Smart Matching</h3>
            <p class="text-gray-600">AI-powered matching helps you find the best partner.</p>
        </div>

        <div class="p-6 bg-pink-50 rounded-2xl shadow text-center">
            <div class="text-4xl mb-4">💬</div>
            <h3 class="text-xl font-bold mb-2">Instant Chat</h3>
            <p class="text-gray-600">Start conversations instantly with your matches.</p>
        </div>

        <div class="p-6 bg-pink-50 rounded-2xl shadow text-center">
            <div class="text-4xl mb-4">❤️</div>
            <h3 class="text-xl font-bold mb-2">Swipe & Match</h3>
            <p class="text-gray-600">Swipe, match, and create meaningful connections.</p>
        </div>

    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 bg-gradient-to-br from-purple-600 to-pink-500 text-white text-center">
    <h2 class="text-4xl mb-4 font-bold">Start Your Love Journey Today</h2>
    <p class="text-lg mb-8 opacity-90">
        Signup now and discover people near you.
    </p>
    <a href="/register" class="bg-white text-pink-600 px-10 py-4 rounded-full text-xl font-bold hover:bg-gray-200">
        Join Now
    </a>
</section>

@endsection
