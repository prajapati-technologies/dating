@extends('layouts.front')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-pink-500 to-purple-800 text-white py-20 px-6">
    <h1 class="text-4xl font-extrabold text-center mb-10">Pricing Plans</h1>

    <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8">

        <div class="bg-white/10 p-6 rounded-2xl text-center">
            <h2 class="text-2xl font-bold">Free</h2>
            <p class="text-sm mt-2">Basic Matching</p>
            <h3 class="text-4xl font-extrabold mt-6">₹0</h3>
        </div>

        <div class="bg-white/20 p-6 rounded-2xl text-center border-2 border-white shadow-xl">
            <h2 class="text-2xl font-bold">Premium</h2>
            <p class="text-sm mt-2">Unlimited Swipes + Boost</p>
            <h3 class="text-4xl font-extrabold mt-6">₹499</h3>
        </div>

        <div class="bg-white/10 p-6 rounded-2xl text-center">
            <h2 class="text-2xl font-bold">Gold</h2>
            <p class="text-sm mt-2">See Who Likes You</p>
            <h3 class="text-4xl font-extrabold mt-6">₹999</h3>
        </div>

    </div>
</div>
@endsection
