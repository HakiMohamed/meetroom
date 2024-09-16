@extends('layouts.app')

@section('title', 'Equipment Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">Equipment Details</h1>
        <div class="grid grid-cols-1 gap-6">
            <div>
                <h2 class="text-lg font-medium text-gray-700">Name</h2>
                <p class="text-gray-600">{{ $equipment->name }}</p>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-700">Description</h2>
                <p class="text-gray-600">{{ $equipment->description }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('room_equipment.edit', $equipment->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-700">Edit Equipment</a>
            <form action="{{ route('room_equipment.destroy', $equipment->id) }}" method="POST" class="inline ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700">Delete Equipment</button>
            </form>
        </div>
    </div>
</div>
@endsection
