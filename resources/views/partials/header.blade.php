@php $settings = \App\Models\Setting::first(); @endphp

<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @if(!empty($settings->logo))
                    <img src="{{ asset('storage/'.$settings->logo) }}" alt="logo" class="w-12 h-12 object-contain">
                @else
                    <div class="w-12 h-12 bg-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(config('app.name','D'),0,1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-bold text-lg text-pink-600">{{ $settings->site_name ?? config('app.name','Dating') }}</div>
                    <div class="text-xs text-gray-500">{{ $settings->tagline ?? 'Find your match' }}</div>
                </div>
            </a>
        </div>

        <nav class="flex items-center gap-4">
            <a href="{{ route('browse') }}" class="text-gray-700 hover:text-pink-600">Browse</a>
            <a href="{{ route('features') }}" class="text-gray-700 hover:text-pink-600">Features</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-pink-600">About</a>
            <a href="{{ route('contact.show') }}" class="text-gray-700 hover:text-pink-600">Contact</a>

            @auth
                <a href="{{ route('swipe') }}" class="ml-4 bg-pink-600 text-white px-4 py-2 rounded-lg">Start Swiping</a>
                <a href="{{ route('dashboard') }}" class="ml-2 text-sm">{{ auth()->user()->name }}</a>
            @else
                <a href="{{ route('login') }}" class="ml-4 text-pink-600 font-semibold">Login</a>
            @endauth
        </nav>
    </div>
</header>
