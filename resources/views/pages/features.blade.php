@extends('layouts.front')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-pink-600 to-purple-700 text-white py-20 px-6">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-4xl font-extrabold text-center mb-10">Amazing Features</h1>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white/10 p-6 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-bold">Smart Swiping</h3>
                <p class="mt-2 text-sm opacity-90">Tinder-style UI with advanced matching.</p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-bold">AI Suggestions</h3>
                <p class="mt-2 text-sm opacity-90">Find perfect matches based on behavior.</p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-bold">Secure Chat</h3>
                <p class="mt-2 text-sm opacity-90">Private and encrypted chat system.</p>
            </div>

        </div>

    </div>
</div>
@endsection
