@extends('admin.layout')

@section('content')

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">⚙️ Website Settings</h1>

    @if(session('success'))
        <div class="bg-green-100 p-3 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl p-6 shadow-xl space-y-6">
        @csrf

        <!-- Website Name -->
        <div>
            <label class="font-semibold">Website Name</label>
            <input type="text" name="site_name" value="{{ $settings->site_name }}"
                   class="w-full border p-3 rounded">
        </div>

        <!-- Website Logo -->
        <div>
            <label class="font-semibold">Website Logo</label>
            <input type="file" name="site_logo" class="w-full">

            @if($settings->site_logo)
                <img src="{{ asset('storage/' . $settings->site_logo) }}" class="h-20 mt-3">
            @endif
        </div>

        <!-- Primary Color -->
        <div>
            <label class="font-semibold">Primary Theme Color</label>
            <input type="color" name="theme_color" value="{{ $settings->theme_color }}"
                   class="w-20 h-10 p-1">
        </div>

        <!-- Footer Text -->
        <div>
            <label class="font-semibold">Footer Text</label>
            <textarea name="footer_text" class="w-full border p-3 rounded">{{ $settings->footer_text }}</textarea>
        </div>

        <button type="submit"
                class="bg-pink-600 text-white px-6 py-3 rounded-xl hover:bg-pink-700 shadow-lg">
            Save Settings
        </button>

    </form>
</div>

@endsection
