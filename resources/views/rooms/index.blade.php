@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-4xl font-bold text-white">Room List</h1>
        <a href="{{ route('rooms.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">Create Room</a>
    </div>

    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg border border-green-300">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-200">
                <tr class="text-left text-gray-700">
                    <th class="py-4 px-6 font-semibold">Room Name</th>
                    <th class="py-4 px-6 font-semibold">Capacity</th>
                    <th class="py-4 px-6 font-semibold">Location</th>
                    <th class="py-4 px-6 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($rooms as $room)
                    <tr>
                        <td class="py-4 px-6 border-b">{{ $room->name }}</td>
                        <td class="py-4 px-6 border-b">{{ $room->capacity }}</td>
                        <td class="py-4 px-6 border-b">{{ $room->location }}</td>
                        <td class="py-4 px-6 border-b flex space-x-2">
                            <a href="{{ route('rooms.show', $room->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline">
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
        {{ $rooms->links() }}
    </div>
</div>

@endsection
