@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-white">Create Role</h1>
    <form action="{{ route('roles.store') }}" method="POST" class="mt-6 bg-white p-8 rounded-lg shadow-md border border-gray-200">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-4 hover:bg-blue-700">Create Role</button>
    </form>
</div>
@endsection
