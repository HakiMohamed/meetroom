@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-white dark:text-white">Edit Reservation</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <ul class="list-disc pl-5 text-red-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Room Selection -->
            <div class="mb-4">
                <label for="room_id" class="block text-gray-700 dark:text-gray-300 font-medium">Room</label>
                <select id="room_id" name="room_id" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="">Select a room</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $room->id == $reservation->room_id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
                @error('room_id')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Meeting Type -->
            <div class="mb-4">
                <label for="meeting_type" class="block text-gray-700 dark:text-gray-300 font-medium">Meeting Type</label>
                <select id="meeting_type" name="meeting_type" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" required>
                    <option value="virtual" {{ $reservation->meeting_type == 'virtual' ? 'selected' : '' }}>Virtual</option>
                    <option value="in-person" {{ $reservation->meeting_type == 'in-person' ? 'selected' : '' }}>In-person</option>
                </select>
                @error('meeting_type')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Platform -->
            <div class="mb-4">
                <label for="platform" class="block text-gray-700 dark:text-gray-300 font-medium">Platform (optional)</label>
                <input type="text" id="platform" name="platform" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('platform', $reservation->platform) }}">
                @error('platform')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject -->
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 dark:text-gray-300 font-medium">Subject (optional)</label>
                <input type="text" id="subject" name="subject" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('subject', $reservation->subject) }}">
                @error('subject')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-gray-700 dark:text-gray-300 font-medium">Start Time</label>
                <input type="datetime-local" id="start_time" name="start_time" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('start_time', \Carbon\Carbon::parse($reservation->start_time)->format('Y-m-d\TH:i')) }}" required>
                @error('start_time')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="end_time" class="block text-gray-700 dark:text-gray-300 font-medium">End Time</label>
                <input type="datetime-local" id="end_time" name="end_time" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" value="{{ old('end_time', \Carbon\Carbon::parse($reservation->end_time)->format('Y-m-d\TH:i')) }}" required>
                @error('end_time')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            

            <!-- Participants -->
            <div class="mb-4">
                <label for="participants" class="block text-gray-700 dark:text-gray-300 font-medium">Participants (Enter emails separated by commas)</label>
                <div id="participant-container" class="flex flex-wrap gap-2 p-2 border border-gray-300 dark:border-gray-600 rounded-md">
                    <!-- Tags will be added here -->
                    @foreach(json_decode($reservation->participants, true) as $participant)
                        <div class="bg-blue-200 text-blue-800 rounded-md px-2 py-1 flex items-center gap-2">
                            <span>{{ $participant }}</span>
                            <button type="button" class="text-blue-500" onclick="this.parentElement.remove()">x</button>
                        </div>
                    @endforeach
                </div>
                <input type="text" id="participants-input" class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200" placeholder="Enter participant emails separated by commas..." value="{{ implode(',', json_decode($reservation->participants, true)) }}">
                <input type="hidden" id="participants" name="participants[]" value="{{ implode(',', json_decode($reservation->participants, true)) }}">
                @error('participants')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Equipment Selection -->
            <div class="mb-4">
                <label for="equipments" class="block text-gray-700 dark:text-gray-300 font-medium">Select Equipment (optional)</label>
                <select id="equipments" name="equipments[]" multiple class="mt-1 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200">
                    @foreach($equipments as $equipment)
                        <option value="{{ $equipment->id }}" {{ $reservation->equipments->contains($equipment->id) ? 'selected' : '' }}>{{ $equipment->name }}</option>
                    @endforeach
                </select>
                @error('equipments')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Update Reservation
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const participantsInput = document.getElementById('participants-input');
        const participantContainer = document.getElementById('participant-container');
        const hiddenParticipantsInput = document.getElementById('participants');

        function addTags(emails) {
            participantContainer.innerHTML = ''; // Clear current tags
            emails.forEach(email => {
                if (email) {
                    const tag = document.createElement('div');
                    tag.className = 'bg-blue-200 text-blue-800 rounded-md px-2 py-1 flex items-center gap-2';
                    tag.innerHTML = `
                        <span>${email}</span>
                        <button type="button" class="text-blue-500" onclick="this.parentElement.remove()">x</button>
                    `;
                    participantContainer.appendChild(tag);
                }
            });
            // Update hidden input
            hiddenParticipantsInput.value = emails.join(',');
        }

        function processEmails(input) {
            const emails = input.split(',').map(email => email.trim()).filter(email => email);
            return emails;
        }

        participantsInput.addEventListener('input', function () {
            const emails = processEmails(participantsInput.value);
            addTags(emails);
        });

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function () {
            const emails = processEmails(participantsInput.value);
            hiddenParticipantsInput.value = emails.join(',');
        });
    });
</script>

@endsection
