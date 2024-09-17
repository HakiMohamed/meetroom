@extends('layouts.app')

@section('content')

<div class="flex-1 rounded p-6 lg:p-8 bg-gray-200 dark:bg-gray-900">
    <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">
        <div class="p-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8">Edit User</h1>
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="firstname" class="block text-gray-700 dark:text-gray-200 font-medium">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                               required>
                        @error('firstname')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="lastname" class="block text-gray-700 dark:text-gray-200 font-medium">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                               required>
                        @error('lastname')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="employeId" class="block text-gray-700 dark:text-gray-200 font-medium">Employee ID</label>
                        <input type="text" id="employeId" name="employeId" value="{{ old('employeId', $user->employeId) }}" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                               required>
                        @error('employeId')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-gray-700 dark:text-gray-200 font-medium">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                               required>
                        @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-gray-700 dark:text-gray-200 font-medium">Password (leave blank to keep current)</label>
                        <input type="password" id="password" name="password" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-gray-700 dark:text-gray-200 font-medium">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2 col-span-1 md:col-span-2">
                        <label for="role_id" class="block text-gray-700 dark:text-gray-200 font-medium">Role</label>
                        <select id="role_id" name="role_id" 
                                class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                                required>
                            <option value="">Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
