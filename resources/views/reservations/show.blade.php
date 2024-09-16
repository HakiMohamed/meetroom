@extends('layouts.app')

@section('title', 'Reservation Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">Reservation Details</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-medium text-gray-700">Room</h2>
                <p class="text-gray-600">{{ $reservation->room->name }}</p>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-700">User</h2>
                <p class="text-gray-600">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</p>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-700">Type</h2>
                <p class="text-gray-600">{{ $reservation->type == 'virtual' ? 'Virtual' : 'In-Person' }}</p>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-700">Date and Time</h2>
                <p class="text-gray-600">{{ $reservation->date->format('d M Y H:i') }}</p>
            </div>
            <div class="md:col-span-2">
                <h2 class="text-lg font-medium text-gray-700">Equipment Needed</h2>
                <p class="text-gray-600">{{ $reservation->equipment ?: 'None' }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-700">Edit Reservation</a>
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700">Delete Reservation</button>
            </form>
        </div>
    </div>
</div>
@endsection
