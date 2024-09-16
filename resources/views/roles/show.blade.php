@extends('layouts.app')

@section('title', 'Role Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-gray-900">Role Details</h1>
            <a href="{{ route('roles.edit', $role->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Edit Role</a>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-gray-700">Role Information</h2>
            <p class="mt-2 text-gray-600"><strong>Role Name:</strong> {{ $role->name }}</p>
            <p class="mt-2 text-gray-600"><strong>Users:</strong>
                @if($role->users->isEmpty())
                    <span class="text-gray-500">No users assigned</span>
                @else
                    @foreach($role->users as $user)
                        <span class="inline-block px-2 py-1 text-xs font-medium text-gray-800 bg-gray-200 rounded">{{ $user->firstname }} {{ $user->lastname }}</span>
                    @endforeach
                @endif
            </p>
        </div>
        <div class="mt-6 flex justify-end">
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete Role</button>
            </form>
        </div>
    </div>
</div>
@endsection
