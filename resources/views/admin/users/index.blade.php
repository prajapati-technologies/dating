@extends('admin.layout')

@section('content')

<div class="px-6 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">👥 Users</h1>

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
                @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- NAME -->
                        <td class="py-4 px-6">{{ $user->name }}</td>

                        <!-- EMAIL -->
                        <td class="py-4 px-6 text-gray-600">{{ $user->email }}</td>

                        <!-- GENDER -->
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full">
                                {{ $user->profile->gender ?? '-' }}
                            </span>
                        </td>

                        <!-- CITY -->
                        <td class="py-4 px-6">{{ $user->profile->city ?? '-' }}</td>

                        <!-- ACTIONS -->
                        <td class="py-4 px-6 flex gap-4">

                            <!-- View -->
                            <a href="{{ route('admin.users.view', $user->id) }}"
                               class="text-blue-600 font-semibold hover:underline">View</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="text-indigo-600 font-semibold hover:underline">Edit</a>
                            <!-- Block / Unblock -->
                            @if($user->is_blocked)
                                <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST">
                                    @csrf
                                    <button class="text-green-600 font-semibold hover:underline">Unblock</button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.block', $user->id) }}" method="POST">
                                    @csrf
                                    <button class="text-orange-600 font-semibold hover:underline">Block</button>
                                </form>
                            @endif

                            <!-- Delete -->
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 font-semibold hover:underline">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection
