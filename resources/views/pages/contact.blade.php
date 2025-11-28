@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-14">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4">Contact Us</h2>

        @if(session('success'))
            <div class="bg-green-100 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <input name="name" placeholder="Your name" class="w-full border p-2 rounded mb-3">
            <input name="email" placeholder="Email" class="w-full border p-2 rounded mb-3">
            <textarea name="message" placeholder="Message" class="w-full border p-2 rounded mb-3"></textarea>
            <button class="bg-pink-600 text-white px-4 py-2 rounded">Send</button>
        </form>
    </div>
</div>
@endsection
