@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="flex gap-6">
        <aside class="w-72 bg-white p-4 rounded-xl shadow">
            <form method="GET" action="{{ route('browse') }}">
                <label class="block text-sm">City</label>
                <input name="city" value="{{ request('city') }}" class="w-full border rounded p-2 mb-3">

                <label class="block text-sm">Gender</label>
                <select name="gender" class="w-full border rounded p-2 mb-3">
                    <option value="">Any</option>
                    <option value="Male" @selected(request('gender')=='Male')>Male</option>
                    <option value="Female" @selected(request('gender')=='Female')>Female</option>
                </select>

                <label class="block text-sm">Age range</label>
                <div class="flex gap-2">
                    <input name="min_age" value="{{ request('min_age') }}" class="w-1/2 border rounded p-2" placeholder="Min">
                    <input name="max_age" value="{{ request('max_age') }}" class="w-1/2 border rounded p-2" placeholder="Max">
                </div>

                <button class="mt-4 bg-pink-600 text-white px-4 py-2 rounded">Apply</button>
            </form>
        </aside>

        <div class="flex-1">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($profiles as $p)
                    <div class="bg-white rounded-xl overflow-hidden shadow">
                        @if($p->profile_photo)
                            <img src="{{ asset('storage/'.$p->profile_photo) }}" class="w-full h-44 object-cover">
                        @else
                            <div class="w-full h-44 bg-gray-200"></div>
                        @endif
                        <div class="p-4">
                            <div class="font-bold">{{ $p->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $p->city ?? '-' }}, {{ $p->age ?? '-' }} yrs</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $profiles->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
