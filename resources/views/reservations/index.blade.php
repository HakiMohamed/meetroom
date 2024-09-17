@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-white dark:text-white">Reservations</h1>
    
    @if(session('status'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="mb-4">
        <a href="{{ route('reservations.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
            Create New Reservation
        </a>
    </div>
    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Meeting Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Start Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">End Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($reservations as $reservation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $reservation->room->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $reservation->meeting_type }}</td>
                            <td class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-gray-300 text-blue-800 dark:bg-gray-600 dark:text-blue-300">{{ $reservation->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $reservation->start_time}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $reservation->end_time}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center">
                                <!-- View Button -->
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="text-blue-500 hover:text-blue-700" title="View">
                                    <button type="button" class="p-2 rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <button type="button" class="p-2 rounded-full hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                <!-- Cancel Button (if user is the creator) -->
                                @if (Auth::id() === $reservation->user_id && $reservation->status === "encours")
                                <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800 p-2 rounded-full hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-500" title="Cancel Reservation">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
    </div>
</div>

@endsection
