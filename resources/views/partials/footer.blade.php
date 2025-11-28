@php $settings = \App\Models\Setting::first(); @endphp

<footer class="bg-gray-50 border-t mt-12">
    <div class="container mx-auto px-4 py-8 flex justify-between items-start">
        <div>
            <div class="font-bold text-lg text-pink-600">{{ $settings->site_name ?? config('app.name','Dating') }}</div>
            <div class="text-sm text-gray-600 mt-2">{{ $settings->footer_text ?? '© '.date('Y') }}</div>
        </div>

        <div class="text-sm text-gray-600">
            <a href="{{ route('terms') }}" class="block">Terms</a>
            <a href="{{ route('privacy') }}" class="block mt-2">Privacy</a>
        </div>
    </div>
</footer>
