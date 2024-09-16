<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RoomMeet</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <style>
        /* Custom animations and transitions */
        input, button {
            transition: all 0.3s ease;
        }

        input:focus {
            transform: scale(1.05);
        }

        button:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="relative text-blue-900 mr-5 dark:text-white text-3xl font-bold tracking-wide group">
                Room <span class="text-blue-400">Meet</span>

                <!-- Underline effect -->
                <span class="absolute left-0 bottom-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-300 scale-x-0 group-hover:scale-x-100 transform transition-transform duration-300 origin-left"></span>
            </a>
        <div class="flex md:order-2 space-x-0 md:space-x-0 rtl:space-x-reverse">
            <button id="theme-toggle" type="button" class="block py-2 pr-4 pl-3 text-gray-700 dark:text-gray-400 border-b border-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            @auth
            <a href="{{ route('logout') }}" class=" flex text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-2xl  px-4 lg:px-5 py-2 lg:py-2.5 mr-2"> 
                <span class="text-red-500 text-2xl mr-1">
                    <i class="bi bi-box-arrow-in-right"></i>
                </span>
                Logout
            </a>
            @else
            <a href="{{ route('login') }}" class=" flex text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-2xl  px-4 lg:px-5 py-2 lg:py-2.5 mr-2"> 
                <span class="text-green-500 text-2xl mr-1">
                    <i class="bi bi-box-arrow-in-left"></i>
                </span>
                Login
            </a>
            <a href="{{ route('register') }}" class="flex text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-2xl px-4 lg:px-5 py-2 lg:py-2.5">
                <span class="text-green-500 text-2xl mr-1">
                    <i class="bi bi-person-plus"></i>
                </span>
                Register
            </a>
            @endauth
            
           
        </div>
       
        </div>
      </nav>

    <!-- Main Content -->
    <main class="pt-24 w-full flex items-center justify-center">
        <div class="w-1/2 p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-105">
            
            <a href="/" class="block text-center mt-8 text-blue-900 dark:text-white text-3xl font-bold tracking-wide group">
                Room <span class="text-blue-400">Meet</span>
                <span class="absolute left-0 bottom-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-300 scale-x-0 group-hover:scale-x-100 transform transition-transform duration-300 origin-left"></span>
            </a>

            <h1 class="text-xl  mt-10 font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl mb-6 animate-fadeIn">
                Create an account
            </h1>
            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                @method('POST')
        
                <!-- Error Display -->
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc pl-5 text-red-500 space-y-1 animate-pulse">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        
                <!-- First Name -->
                <div>
                    <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                    <input type="text" name="firstname" id="firstname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        required>
                </div>
        
                <!-- Last Name -->
                <div>
                    <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                    <input type="text" name="lastname" id="lastname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        required>
                </div>
        
                <!-- Employee ID -->
                <div>
                    <label for="id_employe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID</label>
                    <input type="text" name="id_employe" id="id_employe"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        required>
                </div>
        
                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        placeholder="name@company.com" required>
                </div>
        
                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        required>
                </div>
        
                <!-- Confirm Password -->
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
                    <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-300 transform hover:scale-105"
                        required>
                </div>
        
                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:ring-3 focus:ring-blue-500 transition transform hover:scale-105"
                            required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-400">I accept the <a
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline hover:text-blue-700 transition">Terms and Conditions</a></label>
                    </div>
                </div>
        
                <!-- Register Button -->
                <button type="submit"
                    class="w-full text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 dark:bg-gradient-to-r dark:from-blue-500 dark:to-blue-700 dark:hover:from-blue-600 dark:hover:to-blue-800 font-medium rounded-lg text-sm px-5 py-3 text-center shadow-lg transition transform hover:scale-105">
                    Register Now
                </button>
        
                <!-- Already have an account -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Already have an account? <a href="{{ route('login') }}"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline hover:text-blue-700 transition">Login here</a>
                </p>
            </form>
        </div>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
