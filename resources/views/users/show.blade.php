@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-gray-900">User Details</h1>
            <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Edit User</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-700">Personal Information</h2>
                <p class="mt-2 text-gray-600"><strong>First Name:</strong> {{ $user->firstname }}</p>
                <p class="mt-2 text-gray-600"><strong>Last Name:</strong> {{ $user->lastname }}</p>
                <p class="mt-2 text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="mt-2 text-gray-600"><strong>Roles:</strong>
                    @foreach($user->roles as $role)
                        <span class="inline-block px-2 py-1 text-xs font-medium text-gray-800 bg-gray-200 rounded">{{ $role->name }}</span>
                    @endforeach
                </p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete User</button>
            </form>
        </div>
    </div>
</div>
@endsection
