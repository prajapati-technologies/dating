@extends('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-pink-500 to-purple-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Meet great people near you</h1>
        <p class="max-w-2xl mx-auto text-lg mb-8">Create a profile, swipe, and find your match.</p>

        <div class="flex justify-center gap-4">
            @guest
            <a href="{{ route('register') }}" class="bg-white text-pink-600 px-6 py-3 rounded-lg font-bold">Get Started</a>
            <a href="{{ route('features') }}" class="border border-white px-6 py-3 rounded-lg">Learn more</a>
            @else
            <a href="{{ route('swipe') }}" class="bg-white text-pink-600 px-6 py-3 rounded-lg font-bold">Start Swiping</a>
            @endguest
        </div>
    </div>
</section>

<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Featured Profiles</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($featured as $p)
                <div class="bg-white rounded-xl overflow-hidden shadow">
                    @if(!empty($p->profile_photo))
                        <img src="{{ asset('storage/'.$p->profile_photo) }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-gray-200"></div>
                    @endif
                    <div class="p-3">
                        <div class="font-bold">{{ $p->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $p->city ?? '-' }}, {{ $p->age ?? '-' }} yrs</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
