{{-- resources/views/home.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $settings->site_name ?? 'Dating App' }}</title>
  @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gradient-to-br from-pink-500 to-purple-700 text-white">

  {{-- HEADER --}}
  <header class="px-6 md:px-12 lg:px-20 py-4 flex items-center justify-between bg-white/5 backdrop-blur-md sticky top-0 z-50">
    <div class="flex items-center gap-4">
      @if(!empty($settings->logo))
        <img src="{{ asset('storage/'.$settings->logo) }}" alt="logo" class="h-12 w-12 rounded-full shadow ring-2 ring-white/20">
      @else
        <div class="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center text-lg font-bold">💗</div>
      @endif
      <div>
        <h1 class="text-xl font-extrabold leading-none">{{ $settings->site_name ?? 'LoveConnect' }}</h1>
        <div class="text-xs text-white/70 -mt-1">{{ $settings->tagline ?? 'Find Your Perfect Match Today' }}</div>
      </div>
    </div>

    <nav class="flex items-center gap-4 md:gap-6 text-sm font-semibold">
      <a href="#features" class="hover:text-white/100">Features</a>
      <a href="#howitworks" class="hover:text-white/100">How it works</a>
      <a href="#reviews" class="hover:text-white/100">Reviews</a>
      <a href="{{ route('login') }}" class="hover:underline">Login</a>
      <a href="{{ route('register') }}"
         class="ml-2 inline-flex items-center gap-2 bg-white text-pink-600 px-4 py-2 rounded-xl font-bold shadow hover:bg-gray-100 transition">
         Get Started
      </a>
    </nav>
  </header>

  {{-- HERO: left signup card + right full-bleed photo --}}
  <section class="relative">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center px-6 md:px-12 lg:px-20 py-12">
      {{-- Left column: signup card --}}
      <div class="lg:col-span-5 space-y-6">
        <div class="bg-white/95 rounded-2xl p-6 md:p-8 text-gray-900 shadow-xl">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="text-2xl font-extrabold">Global Online Dating</h2>
              <p class="text-sm text-gray-600 mt-1">Millions of singles, verified profiles, and safe messaging.</p>
            </div>
            <div class="text-sm text-gray-500">Dating.com</div>
          </div>

          {{-- Signup form (simple) --}}
          <form action="{{ route('register') }}" method="GET" class="mt-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <input name="name" type="text" placeholder="Your name" class="px-3 py-2 rounded-lg border border-gray-200">
              <input name="email" type="email" placeholder="Email address" class="px-3 py-2 rounded-lg border border-gray-200">
            </div>

            <div class="flex items-center gap-3">
              <select name="country" class="px-3 py-2 rounded-lg border border-gray-200">
                <option value="">Country</option>
                <option>United States</option>
                <option>India</option>
                <option>United Kingdom</option>
              </select>
              <select name="gender" class="px-3 py-2 rounded-lg border border-gray-200">
                <option value="">I am</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>

            <div class="flex items-center justify-between gap-3">
              <button type="submit" class="w-full bg-pink-600 text-white px-4 py-3 rounded-xl font-bold shadow hover:brightness-105">Take a free tour</button>
            </div>

            <p class="text-xs text-gray-500">By clicking you agree to our Terms & Privacy policy.</p>
          </form>
        </div>

        {{-- feature icons row (small) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="bg-white/10 p-4 rounded-xl text-center">
            <div class="text-2xl">🔒</div>
            <h4 class="mt-2 font-bold text-sm">Protection</h4>
            <p class="text-xs text-white/80 mt-1">Secure & private</p>
          </div>
          <div class="bg-white/10 p-4 rounded-xl text-center">
            <div class="text-2xl">💬</div>
            <h4 class="mt-2 font-bold text-sm">Messaging</h4>
            <p class="text-xs text-white/80 mt-1">Instant chat & video</p>
          </div>
          <div class="bg-white/10 p-4 rounded-xl text-center">
            <div class="text-2xl">✅</div>
            <h4 class="mt-2 font-bold text-sm">Verification</h4>
            <p class="text-xs text-white/80 mt-1">Genuine profiles</p>
          </div>
          <div class="bg-white/10 p-4 rounded-xl text-center">
            <div class="text-2xl">🌐</div>
            <h4 class="mt-2 font-bold text-sm">Community</h4>
            <p class="text-xs text-white/80 mt-1">Global members</p>
          </div>
        </div>
      </div>

      {{-- Right column: hero photo & overlay cards --}}
      <div class="lg:col-span-7 relative">
        <div class="rounded-3xl overflow-hidden shadow-2xl" style="min-height:440px;">
          @if(!empty($settings->hero_image))
            <img src="{{ asset('storage/'.$settings->hero_image) }}" alt="hero" class="w-full h-[440px] object-cover">
          @else
            <img src="{{ asset('images/hero-default.jpg') ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1400&auto=format&fit=crop&ixlib=rb-4.0.3&s=5d7a2e6f0c86df2b7f3c4b6d7d3b1e5a' }}" alt="hero" class="w-full h-[440px] object-cover">
          @endif
        </div>

        {{-- overlay profile cards (small stacked) --}}
        <div class="absolute right-6 bottom-6 grid gap-4">
          <div class="bg-white rounded-xl p-3 w-44 text-gray-900 shadow-lg flex items-center gap-3">
            <img src="https://via.placeholder.com/80" alt="" class="h-12 w-12 rounded-md object-cover">
            <div>
              <div class="font-bold">Amanda, 28</div>
              <div class="text-xs text-gray-600">New York</div>
            </div>
          </div>

          <div class="bg-white rounded-xl p-3 w-44 text-gray-900 shadow-lg flex items-center gap-3">
            <img src="https://via.placeholder.com/80" alt="" class="h-12 w-12 rounded-md object-cover">
            <div>
              <div class="font-bold">Rohit, 38</div>
              <div class="text-xs text-gray-600">Mumbai</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- MEET ONLINE & FEATURES TWO-COLUMN --}}
  <section id="howitworks" class="px-6 md:px-12 lg:px-20 py-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4">Meet online and chat with singles</h2>
        <p class="text-white/80 max-w-xl">Join a community built around genuine connections — perform video calls, message safely, and discover local and global singles who match your interests.</p>

        <div class="mt-6 space-y-4">
          <div class="bg-white/10 p-4 rounded-lg flex items-start gap-4">
            <div class="text-2xl pt-1">🎥</div>
            <div>
              <h4 class="font-bold">Video Dates</h4>
              <p class="text-sm text-white/80">Initiate video calls without sharing personal contact details.</p>
            </div>
          </div>

          <div class="bg-white/10 p-4 rounded-lg flex items-start gap-4">
            <div class="text-2xl pt-1">💬</div>
            <div>
              <h4 class="font-bold">Instant Chat</h4>
              <p class="text-sm text-white/80">Secure one-to-one messaging with read receipts and media sharing.</p>
            </div>
          </div>

          <div class="bg-white/10 p-4 rounded-lg flex items-start gap-4">
            <div class="text-2xl pt-1">🔎</div>
            <div>
              <h4 class="font-bold">Advanced Filters</h4>
              <p class="text-sm text-white/80">Filter by age, distance, interests and more to find better matches.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-center lg:justify-end">
        <div class="bg-white rounded-3xl p-6 shadow w-full max-w-md text-gray-900">
          <img src="https://via.placeholder.com/720x420" alt="video-sample" class="rounded-lg w-full h-44 object-cover">
          <h3 class="mt-4 font-bold">Dynamic virtual dating features</h3>
          <p class="text-sm text-gray-600 mt-2">Discover immersive virtual features like live video, gifts, and interactive rooms to make dating fun and safe.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- EXPLORE DIVERSE PROFILES (grid of profile images) --}}
  <section class="px-6 md:px-12 lg:px-20 py-12">
    <div class="max-w-7xl mx-auto text-center mb-8">
      <h3 class="text-2xl font-extrabold">Explore diverse profiles in 150+ countries</h3>
      <p class="text-white/80 max-w-2xl mx-auto mt-2">Connect with singles across the globe and find matches in your city or internationally.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
      @for($i=0;$i<8;$i++)
        <div class="rounded-lg overflow-hidden shadow-lg">
          <img src="https://picsum.photos/seed/profile{{$i}}/400/400" alt="profile" class="w-full h-40 object-cover">
        </div>
      @endfor
    </div>
  </section>

  {{-- SEARCH STRIP (dark) --}}
  <section class="bg-black/80 py-12">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
      <h3 class="text-2xl font-extrabold text-center">Search for singles online 🔥</h3>
      <p class="text-center text-white/70 mt-2">Filter by age, location and interests to find people who match what you're looking for.</p>

      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white/5 p-6 rounded-lg text-center">
          <img src="https://picsum.photos/seed/a/600/400" alt="" class="w-full h-40 object-cover rounded-md">
          <h4 class="mt-3 font-bold">Mature singles dating online</h4>
        </div>

        <div class="bg-white/5 p-6 rounded-lg text-center">
          <img src="https://picsum.photos/seed/b/600/400" alt="" class="w-full h-40 object-cover rounded-md">
          <h4 class="mt-3 font-bold">Asian singles dating online</h4>
        </div>

        <div class="bg-white/5 p-6 rounded-lg text-center">
          <img src="https://picsum.photos/seed/c/600/400" alt="" class="w-full h-40 object-cover rounded-md">
          <h4 class="mt-3 font-bold">Gay singles dating online</h4>
        </div>
      </div>
    </div>
  </section>

  {{-- REVIEWS / TESTIMONIALS --}}
  <section id="reviews" class="px-6 md:px-12 lg:px-20 py-16 bg-white text-gray-900">
    <div class="max-w-6xl mx-auto">
      <h3 class="text-3xl font-extrabold text-center">Dating.com User Reviews</h3>
      <p class="text-center text-gray-600 mt-2">Real stories from people who've met on our platform.</p>

      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 rounded-2xl bg-gray-50 shadow">
          <p class="italic text-sm">"I didn't expect much from online dating but this app changed everything. Matched within days!"</p>
          <div class="mt-4 flex items-center gap-3">
            <img src="https://via.placeholder.com/48" class="h-12 w-12 rounded-full object-cover">
            <div>
              <div class="font-bold">Lara G.</div>
              <div class="text-xs text-gray-500">Verified Member</div>
            </div>
          </div>
        </div>

        <div class="p-6 rounded-2xl bg-gray-50 shadow">
          <p class="italic text-sm">"Helpful support and genuine matches. I met my partner and we're engaged!"</p>
          <div class="mt-4 flex items-center gap-3">
            <img src="https://via.placeholder.com/48" class="h-12 w-12 rounded-full object-cover">
            <div>
              <div class="font-bold">Marco</div>
              <div class="text-xs text-gray-500">Verified Member</div>
            </div>
          </div>
        </div>

        <div class="p-6 rounded-2xl bg-gray-50 shadow">
          <p class="italic text-sm">"The verification process gave me confidence to meet people safely."</p>
          <div class="mt-4 flex items-center gap-3">
            <img src="https://via.placeholder.com/48" class="h-12 w-12 rounded-full object-cover">
            <div>
              <div class="font-bold">Sara</div>
              <div class="text-xs text-gray-500">Verified Member</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- PRESS FEATURE / CTA (large background image) --}}
  <section class="relative">
    <div class="h-72 lg:h-96 rounded-t-3xl overflow-hidden relative">
      <img src="{{ asset('images/press-bg.jpg') ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1800&auto=format&fit=crop&ixlib=rb-4.0.3&s=19a6d4bd6c9aa8b7b6f2f9f9a1f4b0f3' }}" alt="press" class="w-full h-full object-cover opacity-80">
      <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

      <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center px-6">
          <div class="text-white/90 uppercase text-sm font-semibold">As Featured In</div>
          <div class="mt-4 text-4xl md:text-5xl font-extrabold">Looking for Great Connections?</div>
          <p class="mt-3 text-white/80 max-w-2xl mx-auto">Join a diverse community and start meaningful conversations today. Safe, secure, and full of real people.</p>
          <a href="{{ route('register') }}" class="mt-6 inline-block bg-pink-600 text-white px-6 py-3 rounded-2xl font-bold shadow hover:brightness-105">Take a free tour</a>
        </div>
      </div>
    </div>
  </section>

  {{-- DATING EXPERTS --}}
  <section class="px-6 md:px-12 lg:px-20 py-16 bg-white text-gray-900">
    <div class="max-w-7xl mx-auto text-center mb-8">
      <h3 class="text-3xl font-extrabold">We're working with dating experts</h3>
      <p class="text-gray-600 mt-2">Trusted industry experts to help you build better relationships.</p>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8">
      @foreach([
        ['name'=>'Jamie Z','role'=>'Relationship Coach','text'=>'Helping people build confidence and better first messages.'],
        ['name'=>'Sabrina D','role'=>'Dating Psychologist','text'=>'Advice on communication and building trust.'],
        ['name'=>'Bella G','role'=>'Matchmaking Expert','text'=>'Practical tips on profile and pictures.']
      ] as $expert)
        <div class="bg-gray-50 rounded-2xl p-6 shadow text-left">
          <div class="flex items-center gap-4">
            <img src="https://via.placeholder.com/96" alt="" class="h-20 w-20 rounded-md object-cover">
            <div>
              <div class="font-bold">{{ $expert['name'] }}</div>
              <div class="text-xs text-gray-500">{{ $expert['role'] }}</div>
            </div>
          </div>
          <p class="mt-4 text-sm text-gray-700">{{ $expert['text'] }}</p>
        </div>
      @endforeach
    </div>
  </section>

  {{-- SHARED SUCCESS (center card) --}}
  <section class="px-6 md:px-12 lg:px-20 py-16">
    <div class="max-w-4xl mx-auto text-center bg-white/5 rounded-3xl p-8 backdrop-blur-sm">
      <div class="text-2xl font-extrabold">Our Shared Success</div>
      <div class="mt-6 text-white/90 text-4xl font-bold">26 years</div>
      <div class="mt-2 text-white/70">connecting singles worldwide</div>
    </div>
  </section>

  {{-- ONLINE DATING ADVICE (cards) --}}
  <section class="px-6 md:px-12 lg:px-20 py-16 bg-white text-gray-900">
    <div class="max-w-7xl mx-auto text-center mb-8">
      <h3 class="text-3xl font-extrabold">Online Dating Advice</h3>
      <p class="text-gray-600 mt-2">Tips & articles curated to help you get started and succeed.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="rounded-2xl overflow-hidden shadow">
        <img src="https://picsum.photos/seed/ad1/800/400" class="w-full h-40 object-cover">
        <div class="p-4">
          <h4 class="font-bold">50+ Flirty Text Messages for Her</h4>
          <p class="text-sm text-gray-600 mt-2">Short sample openers and flirty messages to break the ice.</p>
          <div class="mt-3 text-xs text-gray-500">By Staff • 12 Jan 2025</div>
        </div>
      </div>

      <div class="rounded-2xl overflow-hidden shadow">
        <img src="https://picsum.photos/seed/ad2/800/400" class="w-full h-40 object-cover">
        <div class="p-4">
          <h4 class="font-bold">30+ Niche Date Ideas for Him</h4>
          <p class="text-sm text-gray-600 mt-2">Creative and memorable date ideas for every budget.</p>
          <div class="mt-3 text-xs text-gray-500">By Staff • 08 Feb 2025</div>
        </div>
      </div>

      <div class="rounded-2xl overflow-hidden shadow">
        <img src="https://picsum.photos/seed/ad3/800/400" class="w-full h-40 object-cover">
        <div class="p-4">
          <h4 class="font-bold">100+ Best Questions to Ask on a Date</h4>
          <p class="text-sm text-gray-600 mt-2">Keep the conversation flowing with these meaningful prompts.</p>
          <div class="mt-3 text-xs text-gray-500">By Staff • 20 Mar 2025</div>
        </div>
      </div>
    </div>

    <div class="text-center mt-8">
      <a href="#" class="inline-block bg-pink-600 text-white px-6 py-2 rounded-xl font-bold">View More Advice</a>
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="bg-black/30 text-white/90">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 py-12 grid grid-cols-1 md:grid-cols-4 gap-6">
      <div>
        <div class="flex items-center gap-3">
          @if(!empty($settings->logo))
            <img src="{{ asset('storage/'.$settings->logo) }}" class="h-10 w-10 rounded-full">
          @else
            <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center">💗</div>
          @endif
          <div>
            <div class="font-bold">{{ $settings->site_name ?? 'LoveConnect' }}</div>
            <div class="text-xs text-white/70 mt-1">{{ $settings->tagline ?? 'Find Your Perfect Match' }}</div>
          </div>
        </div>

        <p class="text-sm text-white/70 mt-4">{{ $settings->footer_text ?? '© '.date('Y').' LoveConnect. All Rights Reserved.' }}</p>
      </div>

      <div>
        <h6 class="font-bold mb-3">Company</h6>
        <ul class="space-y-2 text-sm text-white/70">
          <li><a href="#" class="hover:underline">About</a></li>
          <li><a href="#" class="hover:underline">Careers</a></li>
          <li><a href="#" class="hover:underline">Press</a></li>
        </ul>
      </div>

      <div>
        <h6 class="font-bold mb-3">Support</h6>
        <ul class="space-y-2 text-sm text-white/70">
          <li><a href="#" class="hover:underline">Help Center</a></li>
          <li><a href="#" class="hover:underline">Safety Tips</a></li>
          <li><a href="#" class="hover:underline">Contact</a></li>
        </ul>
      </div>

      <div>
        <h6 class="font-bold mb-3">Legal</h6>
        <ul class="space-y-2 text-sm text-white/70">
          <li><a href="#" class="hover:underline">Terms & Conditions</a></li>
          <li><a href="#" class="hover:underline">Privacy Policy</a></li>
        </ul>
      </div>
    </div>

    <div class="border-t border-white/10 py-4 text-center text-xs text-white/60">
      <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 flex flex-col md:flex-row items-center justify-between gap-3">
        <div>© {{ date('Y') }} {{ $settings->site_name ?? 'LoveConnect' }} — All rights reserved.</div>
        <div class="flex items-center gap-3">
          <a href="#" class="hover:underline">Privacy</a>
          <span class="opacity-50">•</span>
          <a href="#" class="hover:underline">Cookies</a>
        </div>
      </div>
    </div>
  </footer>

  {{-- Vite JS (if you use Tailwind + JS) --}}
  @vite('resources/js/app.js')
</body>
</html>
