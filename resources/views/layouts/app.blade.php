<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RoomMeet')</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-800 dark:border-gray-700 fixed w-full z-30">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">RoomMeet</span>
            </a>

            <!-- Right Section: Login/Logout -->
            <div class="flex items-center">
                <button id="theme-toggle" type="button" class="block py-2 pr-4 pl-3 text-gray-700 dark:text-gray-400 border-b border-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                @if (Auth::check())
                    <!-- Logout Link -->
                    <a href="{{ route('logout') }}" class="text-gray-900 dark:text-white hover:underline mr-4">Logout</a>
                @else
                    <!-- Login Link -->
                    <a href="{{ route('login') }}" class="text-gray-900 dark:text-white hover:underline mr-4">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex pt-16"> <!-- Adjusted padding for navbar -->
        <!-- Sidebar -->
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-house-door-fill mr-2"></i>Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-people-fill mr-2"></i>Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-person-badge-fill mr-2"></i>Roles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reservations.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-calendar2-check-fill mr-2"></i>Reservations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('equipment.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-tools mr-2"></i>Equipment
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rooms.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-door-open-fill mr-2"></i>Réunion Rooms
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('room_equipment.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-building mr-2"></i>Rooms Equipment
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cancellations.index') }}" class="block py-2 px-3 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-x-circle-fill mr-2"></i>Cancellations
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-0 sm:ml-64 p-4 transition-all duration-300">
            <!-- Content Section -->
            <main>
                @yield('content')
            </main>
        </div>
        @extends('layouts.app')
    </div>

    

    <script src="{{ asset('js/darkmodeEtnav.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
