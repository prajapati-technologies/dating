@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-purple-600 to-pink-500 py-10 px-6">

    <!-- Back Button -->
    <a href="{{ route('matches.index') }}"
       class="text-white text-lg font-semibold mb-6 inline-flex items-center gap-2">
        ← Back to Matches
    </a>

    <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-xl shadow-2xl rounded-3xl overflow-hidden">

        <!-- Profile Image -->
        <div class="relative h-80">
            @if(!empty($partner->profile->profile_photo))
                <img src="{{ asset('storage/' . $partner->profile->profile_photo) }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-300 flex justify-center items-center text-gray-700 text-4xl">
                    ?
                </div>
            @endif

            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

            <!-- User Basic Info -->
            <div class="absolute bottom-4 left-4 text-white">
                <h1 class="text-3xl font-extrabold">
                    {{ $partner->name }},
                    {{ $partner->profile->age ?? '-' }}
                </h1>
                <p class="text-lg text-white/80">
                    {{ $partner->profile->city ?? 'Unknown' }}
                </p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-8">

            <!-- Bio -->
            <h2 class="text-xl font-bold text-gray-800 mb-2">About Me</h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                {{ $partner->profile->bio ?? 'No bio added yet.' }}
            </p>

            <!-- Grid Small Info -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">

                <div class="bg-gray-100 p-4 rounded-2xl shadow text-center">
                    <p class="text-gray-600 text-sm">Gender</p>
                    <p class="text-gray-900 font-bold">
                        {{ $partner->profile->gender ?? '-' }}
                    </p>
                </div>

                <div class="bg-gray-100 p-4 rounded-2xl shadow text-center">
                    <p class="text-gray-600 text-sm">Age</p>
                    <p class="text-gray-900 font-bold">
                        {{ $partner->profile->age ?? '-' }}
                    </p>
                </div>

                <div class="bg-gray-100 p-4 rounded-2xl shadow text-center">
                    <p class="text-gray-600 text-sm">City</p>
                    <p class="text-gray-900 font-bold">
                        {{ $partner->profile->city ?? '-' }}
                    </p>
                </div>

            </div>

            <!-- Start Chat Button -->
            <button disabled
                    class="w-full py-4 bg-pink-600 text-white text-xl font-bold rounded-2xl
                           hover:bg-pink-700 transition shadow-lg">
                💬 Start Chat (coming soon)
            </button>

        </div>

    </div>

</div>

@endsection
