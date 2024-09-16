@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-semibold text-gray-900">Reservations</h1>
        <a href="{{ route('reservations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Add New Reservation</a>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reservations as $reservation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->room->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->date->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="ml-4 text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline ml-4">
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
