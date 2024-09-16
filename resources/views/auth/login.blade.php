<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RoomMeet</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 fixed w-full z-30 top-0">
        <div class="max-w-screen-xl mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Brand -->
            <a href="/" class="text-2xl font-semibold text-gray-900 dark:text-white">RoomMeet</a>
            <!-- Links -->
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-2 rounded">Login</a>
                <a href="{{ route('register') }}" class="text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-2 rounded">Register</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 flex mt-10 items-center justify-center ">
        <div class="w-full mt-10 max-w-md bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border dark:border-gray-700 p-6 space-y-4">
            <a href="/" class="block text-center mt-8 mb-10 text-blue-900 dark:text-white text-3xl font-bold tracking-wide group">
                Room <span class="text-blue-400 ">Meet</span>
                <span class="absolute left-0 bottom-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-300 scale-x-0 group-hover:scale-x-100 transform transition-transform duration-300 origin-left"></span>
            </a>
            <h1 class="text-xl mt-10 font-bold leading-tight text-gray-900 dark:text-white mb-6">Login to Your Account</h1>
            <form method="POST" action="{{ route('login') }}" class="space-y-4 mt-10">
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

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="••••••••" required>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login Now
                </button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-4">
                    Don’t have an account? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Register here</a>
                </p>
            </form>
        </div>
    </main>
</body>
</html>
