@extends('admin.layout')

@section('content')

<h1 class="text-3xl font-bold mb-8">User Profile</h1>

<div class="bg-white p-8 rounded-xl shadow-lg max-w-4xl">

    <div class="flex gap-8">

        <!-- Profile Photo -->
        <div>
            @if($user->profile && $user->profile->profile_photo)
                <img src="{{ asset($user->profile->profile_photo) }}" 
                     class="w-40 h-40 object-cover rounded-xl shadow">
            @else
                <div class="w-40 h-40 bg-gray-300 rounded-xl flex items-center justify-center">No Photo</div>
            @endif
        </div>

        <!-- Basic Info -->
        <div class="space-y-3">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Gender:</strong> {{ $user->profile->gender ?? '-' }}</p>
            <p><strong>Age:</strong> {{ $user->profile->age ?? '-' }}</p>
            <p><strong>City:</strong> {{ $user->profile->city ?? '-' }}</p>
        </div>

    </div>

    <!-- BIO -->
    <div class="mt-6">
        <h3 class="font-bold mb-2">Bio</h3>
        <p class="bg-gray-100 p-4 rounded">{{ $user->profile->bio ?? '—' }}</p>
    </div>


    <!-- Other Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

        <div class="bg-gray-50 p-5 rounded-xl">
            <h3 class="font-bold mb-3">Personal Details</h3>

            <p><strong>Height:</strong> {{ $user->profile->height ?? '-' }}</p>
            <p><strong>Weight:</strong> {{ $user->profile->weight ?? '-' }}</p>
            <p><strong>Drink:</strong> {{ $user->profile->drink ?? '-' }}</p>
            <p><strong>Smoke:</strong> {{ $user->profile->smoke ?? '-' }}</p>
            <p><strong>Education:</strong> {{ $user->profile->education ?? '-' }}</p>
            <p><strong>Profession:</strong> {{ $user->profile->profession ?? '-' }}</p>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <h3 class="font-bold mb-3">Religion / Community</h3>

            <p><strong>Religion:</strong> {{ $user->profile->religion ?? '-' }}</p>
            <p><strong>Caste:</strong> {{ $user->profile->caste ?? '-' }}</p>
            <p><strong>Marital Status:</strong> {{ $user->profile->marital_status ?? '-' }}</p>
            <p><strong>Children:</strong> {{ $user->profile->children ?? '-' }}</p>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <h3 class="font-bold mb-3">Preferences</h3>

            <p><strong>Looking For:</strong> {{ $user->profile->looking_for ?? '-' }}</p>
            <p><strong>Sexual Orientation:</strong> {{ $user->profile->sexual_orientation ?? '-' }}</p>
            <p><strong>Preferred Gender:</strong> {{ $user->profile->preferred_gender ?? '-' }}</p>
            <p><strong>Preferred City:</strong> {{ $user->profile->preferred_city ?? '-' }}</p>
            <p><strong>Min Age Pref:</strong> {{ $user->profile->min_age_pref ?? '-' }}</p>
            <p><strong>Max Age Pref:</strong> {{ $user->profile->max_age_pref ?? '-' }}</p>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <h3 class="font-bold mb-3">Interests</h3>
            <p class="bg-gray-100 p-3 rounded">
                {{ $user->profile->interests ?? '—' }}
            </p>
        </div>

    </div>

</div>

@endsection
