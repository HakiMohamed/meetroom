@extends('layouts.app')

@section('title', 'Equipments')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-semibold text-gray-900">Equipments</h1>
        <a href="{{ route('equipment.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Add New Equipment</a>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($equipment as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('equipment.show', $item->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        <a href="{{ route('equipment.edit', $item->id) }}" class="ml-4 text-yellow-600 hover:text-yellow-800">Edit</a>
                        <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" class="inline ml-4">
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
