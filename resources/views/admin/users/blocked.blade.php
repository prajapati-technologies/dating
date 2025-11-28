@extends('admin.layout')

@section('content')

<div class="px-6 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">🚫 Blocked Users</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5 font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

        <table class="w-full">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-4 px-6 text-left font-semibold">Name</th>
                    <th class="py-4 px-6 text-left font-semibold">Email</th>
                    <th class="py-4 px-6 text-left font-semibold">Gender</th>
                    <th class="py-4 px-6 text-left font-semibold">City</th>
                    <th class="py-4 px-6 text-left font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-4 px-6">{{ $user->name }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $user->email }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                                {{ $user->profile->gender ?? '-' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">{{ $user->profile->city ?? '-' }}</td>

                        <td class="py-4 px-6 flex gap-4">

                            <!-- View -->
                            <a href="{{ route('admin.users.view', $user->id) }}"
                               class="text-blue-600 font-semibold hover:underline">View</a>

                            <!-- Unblock -->
                            <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST">
                                @csrf
                                <button class="text-green-600 font-semibold hover:underline">
                                    Unblock
                                </button>
                            </form>

                            <!-- Delete -->
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this user permanently?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 font-semibold hover:underline">Delete</button>
                            </form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            No blocked users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection
