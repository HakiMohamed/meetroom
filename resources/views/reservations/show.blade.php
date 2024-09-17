@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Reservation Details</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-8 rounded-lg shadow-lg">
        <!-- Room and Meeting Information -->
        <div>
            <h3 class="text-2xl font-semibold mb-4">Room: {{ $reservation->room->name }}</h3>
            <p class="text-gray-700 mb-2"><strong>Meeting Type:</strong> {{ ucfirst($reservation->meeting_type) }}</p>
            <p class="text-gray-700 mb-2"><strong>Platform:</strong> {{ $reservation->platform ?? 'N/A' }}</p>
            <p class="text-gray-700 mb-2"><strong>Subject:</strong> {{ $reservation->subject }}</p>
            <p class="text-gray-700 mb-2"><strong>Start Time:</strong> {{ $reservation->start_time }}</p>
            <p class="text-gray-700 mb-2"><strong>End Time:</strong> {{ $reservation->end_time  }}</p>
            <p class="text-gray-700"><strong>Status:</strong> <span class="px-2 py-1 rounded bg-blue-100 text-blue-800">{{ ucfirst($reservation->status) }}</span></p>
        </div>

        <!-- Equipments and Participants -->
        <div>
            <h4 class="text-xl font-semibold mb-4">Equipments</h4>
            <ul class="list-disc list-inside text-gray-700">
                @forelse($reservation->equipments as $equipment)
                    <li>{{ $equipment->name }}</li>
                @empty
                    <li>No equipment selected.</li>
                @endforelse
            </ul>

            <h4 class="text-xl font-semibold mt-6 mb-4">Participants</h4>
            <ul class="list-disc list-inside text-gray-700">
                @forelse(json_decode($reservation->participants, true) as $participant)
                    <li>{{ $participant }}</li>
                @empty
                    <li>No participants added.</li>
                @endforelse
            </ul>
        </div>

        <!-- Created By Section -->
        <div class="col-span-1 md:col-span-2 mt-6">
            <h4 class="text-xl font-semibold">Created By:</h4>
            <p class="text-gray-700">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }} ({{ $reservation->user->email }})</p>

            @if (Auth::id() === $reservation->user_id)
              <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Cancel Reservation</button>
              </form>
            @endif

            <div class="mt-6">
                <a href="{{ route('reservations.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-md">Back to Reservations</a>
            </div>
        </div>
    </div>
</div>
@endsection
