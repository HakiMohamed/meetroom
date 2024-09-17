<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RoomMeet</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    

    <main class="pt-24 flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
            <a href="/" class="block text-center text-blue-900 dark:text-white text-3xl font-bold">Room <span class="text-blue-400">Meet</span></a>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Login to Your Account</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @method('POST')

                @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc pl-5 text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Identifier (email or EmployeId) -->
                <div class="mb-4">
                    <label for="identifier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email or Employee ID</label>
                    <input type="text" name="identifier" id="identifier" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:text-white" placeholder="Email or Employee ID" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:text-white" placeholder="••••••••" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-700 text-white rounded-lg py-2.5 hover:bg-blue-800">Login Now</button>

                
            </form>
        </div>
    </main>
</body>

</html>
