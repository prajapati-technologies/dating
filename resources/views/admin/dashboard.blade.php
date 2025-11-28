@extends('admin.layout')

@section('content')

<div class="px-6 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-10">📊 Analytics Dashboard</h1>

    <!-- ========== TOP STATS ========== -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">👥 Total Users</h3>
            <p class="text-4xl font-bold">{{ $totalUsers }}</p>
        </div>

        <!-- Blocked -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">🚫 Blocked</h3>
            <p class="text-4xl font-bold text-red-500">{{ $blockedUsers }}</p>
        </div>

        <!-- Profiles -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">📝 Profiles</h3>
            <p class="text-4xl font-bold text-blue-500">{{ $profiles }}</p>
        </div>

        <!-- Female -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">👩 Female</h3>
            <p class="text-4xl font-bold text-pink-500">{{ $female }}</p>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">👨 Male</h3>
            <p class="text-4xl font-bold text-indigo-500">{{ $male }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">⚧ Other</h3>
            <p class="text-4xl font-bold text-purple-500">{{ $other }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="text-gray-600 text-sm">🟢 Online Users</h3>
            <p class="text-4xl font-bold text-green-500">Coming Soon</p>
        </div>

    </div>


    <!-- ========== CHARTS ROW ========== -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- Monthly Users -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold mb-3">📈 Monthly User Registrations</h2>
            <canvas id="userChart"></canvas>
        </div>

        <!-- Monthly Profiles -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold mb-3">📝 Monthly Profile Creation</h2>
            <canvas id="profileChart"></canvas>
        </div>

    </div>


    <!-- ========== TOP CITIES + RECENT USERS ========== -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-10">

        <!-- Top Cities -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold mb-3">🏙 Top Cities</h2>

            <ul class="space-y-3">
                @foreach($topCities as $city)
                <li class="flex justify-between">
                    <span class="font-semibold">{{ $city->city ?? 'Unknown' }}</span>
                    <span class="text-gray-600">{{ $city->count }} users</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Recent Users -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-semibold mb-3">🆕 Recent Users</h2>

            <ul class="space-y-3">
                @foreach($recentUsers as $u)
                <li class="flex justify-between">
                    <span class="font-semibold">{{ $u->name }}</span>
                    <span class="text-gray-600">{{ $u->created_at->diffForHumans() }}</span>
                </li>
                @endforeach
            </ul>
        </div>

    </div>

</div>


<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Monthly Users
new Chart(document.getElementById('userChart'), {
    type: 'line',
    data: {
        labels: [1,2,3,4,5,6,7,8,9,10,11,12],
        datasets: [{
            label: 'Users Registered',
            data: {!! json_encode(array_values($monthlyUsers->toArray())) !!},
            borderColor: '#4f46e5',
            tension: .4
        }]
    }
});

// Monthly Profiles
new Chart(document.getElementById('profileChart'), {
    type: 'bar',
    data: {
        labels: [1,2,3,4,5,6,7,8,9,10,11,12],
        datasets: [{
            label: 'Profiles Created',
            data: {!! json_encode(array_values($monthlyProfiles->toArray())) !!},
            backgroundColor: '#ec4899'
        }]
    }
});
</script>

@endsection
