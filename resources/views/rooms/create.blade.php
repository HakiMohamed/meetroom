@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-white dark:text-white">Create Room</h1>
    <form action="{{ route('rooms.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">Room Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                @error('name')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 dark:text-gray-300 font-medium">Capacity</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                @error('capacity')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 dark:text-gray-300 font-medium">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                @error('location')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Create Room
            </button>
        </div>
    </form>
</div>

@endsection
