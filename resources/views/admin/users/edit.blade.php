@extends('admin.layout')
@section('content')

<h1 class="text-3xl font-bold mb-8">Edit User Profile</h1>
<div class="bg-white p-8 rounded-xl shadow-lg max-w-4xl">

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block mb-1 font-semibold">Name</label>
                <input name="name" value="{{ $user->name }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input name="email" value="{{ $user->email }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Gender</label>
                <input name="gender" value="{{ $user->profile->gender ?? '' }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">City</label>
                <input name="city" value="{{ $user->profile->city ?? '' }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Age</label>
                <input name="age" value="{{ $user->profile->age ?? '' }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Bio</label>
                <textarea name="bio" class="w-full border p-2 rounded">{{ $user->profile->bio ?? '' }}</textarea>
            </div>  
                   
            <!-- Add other profile fields as needed -->
        </div>
        <div class="mt-6">
            <button class="bg-pink-600 text-white px-4 py-2 rounded">Update Profile</button>
        </div>
    </form>
</div>
@endsection