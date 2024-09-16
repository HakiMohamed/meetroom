@extends('layouts.app')

@section('title', 'Cancellation Details')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">Cancellation Details</h1>
        <div class="grid grid-cols-1 gap-6">
            <div>
                <h2 class="text-lg font-medium text-gray-700">Reservation ID</h2>
                <p class="text-gray-600">{{ $cancellation->reservation_id }}</p>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-700">Reason</h2>
                <p class="text-gray-600">{{ $cancellation->reason }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('cancellations.edit', $cancellation->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-700">Edit Cancellation</a>
            <form action="{{ route('cancellations.destroy', $cancellation->id) }}" method="POST" class="inline ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700">Delete Cancellation</button>
            </form>
        </div>
    </div>
</div>
@endsection
