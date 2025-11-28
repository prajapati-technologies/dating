<header class="w-full bg-white shadow-md py-4 px-6 flex items-center justify-between">

    <!-- Logo -->
    <div class="flex items-center gap-3">
        @if(setting('logo'))
            <img src="{{ asset('storage/' . setting('logo')) }}" class="h-10 rounded">
        @endif
        <h1 class="text-xl font-bold text-pink-600">
            {{ setting('site_name') ?? 'Dating App' }}
        </h1>
    </div>

    <!-- Navigation -->
    <nav class="hidden md:flex gap-8 text-gray-700 font-medium">
        <a href="/" class="hover:text-pink-600">Home</a>
        <a href="/features" class="hover:text-pink-600">Features</a>
        <a href="/pricing" class="hover:text-pink-600">Pricing</a>
        <a href="/contact" class="hover:text-pink-600">Contact</a>
    </nav>

    <!-- Login Button -->
    <div>
        <a href="/login" class="bg-pink-600 text-white px-5 py-2 rounded-xl shadow hover:bg-pink-700">
            Login
        </a>
    </div>

</header>
