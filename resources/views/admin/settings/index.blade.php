@extends('admin.layout')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Site Settings</h1>

    <form action="{{ route('admin.settings.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1">Site Name</label>
                <input name="site_name" value="{{ $settings->site_name ?? '' }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">Tagline</label>
                <input name="tagline" value="{{ $settings->tagline ?? '' }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">Logo (PNG)</label>
                <input type="file" name="logo" class="w-full">
            </div>
            <div>
                <label class="block mb-1">Favicon</label>
                <input type="file" name="favicon" class="w-full">
            </div>
        </div>

        <div class="mt-4">
            <button class="bg-pink-600 text-white px-4 py-2 rounded">Save Settings</button>
        </div>
    </form>
</div>
@endsection
