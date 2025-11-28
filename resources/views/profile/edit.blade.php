@extends('layouts.app')

@section('content')
     @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-center font-semibold border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    <div class="min-h-screen bg-gradient-to-br from-pink-500 to-purple-600 py-10 flex justify-center px-4">
        
        <div class="w-full max-w-[750px] bg-white shadow-2xl rounded-3xl p-8">

            <!-- Heading -->
            <h1 class="text-center text-3xl font-extrabold text-pink-600 mb-2">
                ✨ Edit Your Profile
            </h1>

            <p class="text-center text-gray-500 mb-8 text-sm">
                Make your profile attractive — better profiles get more matches ❤️
            </p>

            <!-- Profile Photo -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="flex flex-col items-center mb-8">
                    @if(!empty($profile->profile_photo))
                        <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl" />
                    @else
                        <div class="w-32 h-32 rounded-full bg-pink-200 flex items-center justify-center text-pink-700 text-4xl font-bold">
                            ?
                        </div>
                    @endif

                    <label class="mt-4 cursor-pointer bg-pink-600 hover:bg-pink-700 text-white py-2 px-6 rounded-full shadow transition font-semibold">
                        Upload New Photo
                        <input type="file" name="profile_photo" class="hidden">
                    </label>
                </div>
                <!-- Basic Info -->
                <div class="bg-pink-50 p-6 rounded-2xl shadow border border-pink-100">
                    <h2 class="text-lg font-bold text-pink-700 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                        </svg>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                            <select name="gender" class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $profile->gender=='Male'?'selected':'' }}>Male</option>
                                <option value="Female" {{ $profile->gender=='Female'?'selected':'' }}>Female</option>
                                <option value="Other" {{ $profile->gender=='Other'?'selected':'' }}>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Age</label>
                            <input type="number" name="age" value="{{ $profile->age }}" 
                                class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">City</label>
                            <input type="text" name="city" value="{{ $profile->city }}" 
                                class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        </div>
                    </div>
                </div>

                <!-- About You -->
                <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-1.828 4.656L14.757 8.5l-2.121 2.121-5.043 5.043-3.536.707.707-3.536 5.043-5.043 2.121-2.121z"></path>
                        </svg>
                        About You
                    </h2>

                    <textarea name="bio" rows="4" 
                        class="w-full border rounded-xl p-4 shadow-sm focus:ring-pink-500 focus:border-pink-500">{{ $profile->bio }}</textarea>
                </div>

                <!-- Lifestyle -->
                <div class="bg-pink-50 p-6 rounded-2xl shadow border border-pink-100">
                    <h2 class="text-lg font-bold text-pink-700 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M12 2a1 1 0 011 1v2a1 1 0 01-2 0V3a1 1 0 011-1zm-4 4a1 1 0 00-1 1v3a1 1 0 002 0V7a1 1 0 00-1-1zm6 0a1 1 0 00-1 1v7a1 1 0 002 0V7a1 1 0 00-1-1zm-4 4a1 1 0 00-1 1v5a1 1 0 002 0v-5a1 1 0 00-1-1z"></path>
                        </svg>
                        Lifestyle & Preferences
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Height (in cm)</label>
                            <input type="number" name="height" value="{{ $profile->height }}" 
                                class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Relationship Type</label>
                            <select name="relationship_type" 
                                class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                                <option value="">Select</option>
                                <option value="Long Term" {{ $profile->relationship_type=='Long Term'?'selected':'' }}>Long Term</option>
                                <option value="Short Term" {{ $profile->relationship_type=='Short Term'?'selected':'' }}>Short Term</option>
                                <option value="Friendship" {{ $profile->relationship_type=='Friendship'?'selected':'' }}>Friendship</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Smoking</label>
                            <select name="smoking" class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                                <option value="">Select</option>
                                <option value="Yes" {{ $profile->smoking=='Yes'?'selected':'' }}>Yes</option>
                                <option value="No" {{ $profile->smoking=='No'?'selected':'' }}>No</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Drinking</label>
                            <select name="drinking" class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500">
                                <option value="">Select</option>
                                <option value="Yes" {{ $profile->drinking=='Yes'?'selected':'' }}>Yes</option>
                                <option value="No" {{ $profile->drinking=='No'?'selected':'' }}>No</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Interests -->
                <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m5.656-2.656A4 4 0 0014.242 2H5.757a4 4 0 00-2.829 1.171l-.171.171V6a2 2 0 002 2h10a2 2 0 002-2V3.828l-.171-.171zM4 10a2 2 0 00-2 2v2a2 2 0 002 2h12a2 2 0 002-2v-2a2 2 0 00-2-2H4z"></path>
                        </svg>
                        Interests
                    </h2>

                    <input type="text" name="interests" 
                        class="w-full border rounded-xl p-3 shadow-sm focus:ring-pink-500 focus:border-pink-500"
                        placeholder="e.g., Music, Travel, Coding"
                        value="{{ $profile->interests }}">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-4 bg-pink-600 hover:bg-pink-700 text-white rounded-2xl shadow-md text-lg font-bold transition">
                    Save Profile Changes
                </button>

            </form>
        </div>
    </div>

@endsection
