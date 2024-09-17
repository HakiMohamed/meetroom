@extends('layouts.app')

@section('content')
<div class="flex-1 rounded p-6 lg:p-8 bg-gray-200 dark:bg-gray-900">
    <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8">Users List</h1>
                <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    <i class="fa-solid fa-plus "></i> Create User
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-lg rounded-lg border border-gray-300 divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr class="text-left text-gray-700">
                            <th class="py-4 px-6 font-semibold">First Name</th>
                            <th class="py-4 px-6 font-semibold">Last Name</th>
                            <th class="py-4 px-6 font-semibold">Email</th>
                            <th class="py-4 px-6 font-semibold">Role</th>
                            <th class="py-4 px-6 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach($users as $user)
                            <tr>
                                <td class="py-4 px-6 border-b">{{ $user->firstname }}</td>
                                <td class="py-4 px-6 border-b">{{ $user->lastname }}</td>
                                <td class="py-4 px-6 border-b">{{ $user->email }}</td>
                                <td class="py-4 px-6 border-b">
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $user->role->name ?? 'No role' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 border-b flex space-x-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-6 shadow-lg p-5 bg-gray-400 rounded-lg text-white">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
