@extends('admin.layout')

@section('content')

<h1 class="text-3xl font-bold mb-8">User Profile</h1>

<div class="bg-white p-8 rounded-xl shadow-lg max-w-3xl">

    <div class="flex gap-8">
        
        <!-- Image -->
        <div>
            @if($user->profile && $user->profile->profile_photo)
                <img src="{{ asset('storage/' . $user->profile->profile_photo) }}" class="w-40 h-40 object-cover rounded-xl shadow">
            @else
                <div class="w-40 h-40 bg-gray-300 rounded-xl flex items-center justify-center">No Photo</div>
            @endif
        </div>

        <!-- Info -->
        <div class="space-y-3">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Gender:</strong> {{ $user->profile->gender ?? '-' }}</p>
            <p><strong>Age:</strong> {{ $user->profile->age ?? '-' }}</p>
            <p><strong>City:</strong> {{ $user->profile->city ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="font-bold mb-2">Bio</h3>
        <p class="bg-gray-100 p-4 rounded">{{ $user->profile->bio ?? '—' }}</p>
    </div>

</div>

@endsection
