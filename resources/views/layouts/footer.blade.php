<footer class="bg-pink-600 text-white py-10 mt-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6">

        <div>
            <h3 class="text-xl font-bold mb-3">{{ setting('site_name') }}</h3>
            <p class="text-sm opacity-80">{{ setting('tagline') }}</p>
        </div>

        <div>
            <h3 class="font-bold mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="/about" class="hover:underline">About</a></li>
                <li><a href="/features" class="hover:underline">Features</a></li>
                <li><a href="/pricing" class="hover:underline">Pricing</a></li>
                <li><a href="/contact" class="hover:underline">Contact</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-bold mb-2">Follow Us</h3>
            <div class="flex gap-4 text-2xl">
                @if(setting('facebook')) <a href="{{ setting('facebook') }}">📘</a> @endif
                @if(setting('instagram')) <a href="{{ setting('instagram') }}">📸</a> @endif
                @if(setting('twitter')) <a href="{{ setting('twitter') }}">🐦</a> @endif
                @if(setting('youtube')) <a href="{{ setting('youtube') }}">▶️</a> @endif
            </div>
        </div>

    </div>

    <div class="text-center text-sm mt-6 opacity-75">
       {{ setting('footer_text') ?? '© All Rights Reserved.' }}
    </div>
</footer>
