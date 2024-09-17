@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-4 text-gray-800 dark:text-white">Equipment Details</h1>

        <div class="mb-4">
            <span class="block text-gray-700 dark:text-gray-300 font-medium">Equipment Name</span>
            <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $equipment->name }}</p>
        </div>

        <div class="mb-4">
            <span class="block text-gray-700 dark:text-gray-300 font-medium">Description</span>
            <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $equipment->description }}</p>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('equipments.edit', $equipment->id) }}" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Edit Equipment
            </a>
            <a href="{{ route('equipments.index') }}" class="ml-4 bg-gray-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300 ease-in-out">
                Back to List
            </a>
        </div>
    </div>
</div>

@endsection
