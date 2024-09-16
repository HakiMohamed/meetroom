@extends('layouts.app')

@section('title', 'Room Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-gray-900">Room Details</h1>
            <a href="{{ route('rooms.edit', $room->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Edit Room</a>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-gray-700">Room Information</h2>
            <p class="mt-2 text-gray-600"><strong>Name:</strong> {{ $room->name }}</p>
            <p class="mt-2 text-gray-600"><strong>Capacity:</strong> {{ $room->capacity }}</p>
            <p class="mt-2 text-gray-600"><strong>Location:</strong> {{ $room->location }}</p>
        </div>
        <div class="mt-6 flex justify-end">
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete Room</button>
            </form>
        </div>
    </div>
</div>
@endsection
