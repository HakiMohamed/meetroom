@extends('layouts.app')

@section('title', 'Rooms')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-semibold text-gray-900">Meeting Rooms</h1>
        <a href="{{ route('rooms.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Add New Room</a>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($rooms as $room)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->capacity }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->location }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('rooms.show', $room->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="ml-4 text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
