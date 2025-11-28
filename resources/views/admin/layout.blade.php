<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons (Heroicons) -->
    <script src="https://unpkg.com/heroicons@2.0.16/dist/heroicons.js"></script>

</head>

<body class="bg-gray-100 flex">

    <!-- 🟦 SIDEBAR -->
    <aside class="w-64 bg-white shadow-xl min-h-screen p-6 hidden md:block">

        <h1 class="text-2xl font-extrabold text-gray-800 mb-10">Admin Panel</h1>

        <nav class="space-y-3">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-gray-200 transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-300 font-bold' : '' }}">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-10 0h10"/>
                </svg>
                Dashboard
            </a>

            <!-- Users -->
            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-gray-200 transition
               {{ request()->routeIs('admin.users') ? 'bg-gray-300 font-bold' : '' }}">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M12 14a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
                Users
            </a>

            <!-- Blocked Users -->
<a href="{{ route('admin.blocked.users') }}"
   class="flex items-center gap-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-gray-200 transition
   {{ request()->routeIs('admin.blocked.users') ? 'bg-gray-300 font-bold' : '' }}">
    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M18.364 5.636A9 9 0 015.636 18.364m12.728 0A9 9 0 015.636 5.636"/>
    </svg>
    Blocked Users
</a>


            <!-- Settings -->
            <a href="{{ route('admin.settings') }}"
               class="flex items-center gap-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-gray-200 transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.325 4.317a1 1 0 011.35 0l.867.867a1 1 0 00.707.293h1.517a1 1 0 01.95.69l.447 1.34a1 1 0 00.516.593l1.293.647a1 1 0 010 1.788l-1.293.647a1 1 0 00-.516.593l-.447 1.34a1 1 0 01-.95.69H13.25a1 1 0 00-.707.293l-.867.867a1 1 0 01-1.35 0l-.867-.867a1 1 0 00-.707-.293H8.55a1 1 0 01-.95-.69l-.447-1.34a1 1 0 00-.516-.593l-1.293-.647a1 1 0 010-1.788l1.293-.647a1 1 0 00.516-.593l.447-1.34a1 1 0 01.95-.69h1.517a1 1 0 00.707-.293l.867-.867z"/>
                </svg>
                Settings
            </a>

        </nav>
    </aside>

    <!-- 🔷 MAIN AREA -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-700">Admin Panel</h2>

            <div class="flex items-center gap-4">
                <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

    </main>

</body>
</html>
