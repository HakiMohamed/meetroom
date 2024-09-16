@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-900">Edit Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="mt-6 bg-white p-8 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-4 hover:bg-blue-700">Update Role</button>
    </form>
</div>
@endsection
