<ul class="mt-6 leading-10">
    @if (Auth::user()->hasRole('admin'))
    <li class="relative px-2 py-1 ">
        <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500" 
            href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="ml-4">DASHBOARD</span>
        </a>
    </li>
{{-----------------------------------------------Users start----------------------------------------------------}}                           
    <li class="relative px-2 py-1" x-data="{ Open : false  }">
        <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
            x-on:click="Open = !Open">
            <span
                class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
                <i class="fa-solid fa-users fa-lg"></i>
                <span class="ml-4">USERS</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
                class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
                class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        <div x-show.transition="Open" style="display:none;">
            <ul x-transition:enter="transition-all  ease-in-out duration-300"
            x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl"
            x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl"
            x-transition:leave-end="opacity-0 max-h-0"
            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
            aria-label="submenu">
        
            <li class="px-2 py-1">
                <a href="/users/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
                    <i class="fa-solid fa-user fa-lg"></i>
                    <span>Create User</span>
                </a>
            </li>
            <li class="px-2 py-1">
                <a href="/users" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
                    <i class="fa-solid fa-list fa-lg"></i>
                    <span>Users liste</span>
                </a>
            </li>
        </ul>
        
        </div>
    </li>
{{-----------------------------------------------Users  end----------------------------------------------------}}                           

{{-----------------------------------------------rooms start----------------------------------------------------}}                           

<li class="relative px-2 py-1" x-data="{ Open : false  }">
<div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
x-on:click="Open = !Open">
<span
class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
<i class="fa-solid fa-door-open fa-lg"></i>
<span class="ml-4"> ROOMS</span>
</span>
<svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
stroke="currentColor" style="display: none;">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M15 19l-7-7 7-7" />
</svg>

<svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
stroke="currentColor" style="display: none;">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M19 9l-7 7-7-7" />
</svg>
</div>

<div x-show.transition="Open" style="display:none;">
<ul x-transition:enter="transition-all  ease-in-out duration-300"
x-transition:enter-start="opacity-25 max-h-0"
x-transition:enter-end="opacity-100 max-h-xl"
x-transition:leave="transition-all ease-in-out duration-300"
x-transition:leave-start="opacity-100 max-h-xl"
x-transition:leave-end="opacity-0 max-h-0"
class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
aria-label="submenu">

<li class="px-2 py-1">
<a href="/rooms/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
    <i class="fa-solid fa-door-open"></i>
<span>Create Room</span>
</a>
</li>
<li class="px-2 py-1">
<a href="/rooms" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
<i class="fa-solid fa-list fa-lg"></i>
<span>Room liste</span>
</a>
</li>
</ul>

</div>
</li>
{{-----------------------------------------------rooms end----------------------------------------------------}}                           


{{-----------------------------------------------equipemengt start----------------------------------------------------}}                           
<li class="relative px-2 py-1" x-data="{ Open : false  }">
    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
    x-on:click="Open = !Open">
    <span
    class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
    <i class="fa-solid fa-toolbox fa-lg"></i>
    <span class="ml-4"> equipments</span>
    </span>
    <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M15 19l-7-7 7-7" />
    </svg>
    
    <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M19 9l-7 7-7-7" />
    </svg>
    </div>
    
    <div x-show.transition="Open" style="display:none;">
    <ul x-transition:enter="transition-all  ease-in-out duration-300"
    x-transition:enter-start="opacity-25 max-h-0"
    x-transition:enter-end="opacity-100 max-h-xl"
    x-transition:leave="transition-all ease-in-out duration-300"
    x-transition:leave-start="opacity-100 max-h-xl"
    x-transition:leave-end="opacity-0 max-h-0"
    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
    aria-label="submenu">
    
    <li class="px-2 py-1">
    <a href="/equipments/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
        <i class="fa-solid fa-toolbox fa-lg"></i>

    <span>Create Equipment</span>
    </a>
    </li>
    <li class="px-2 py-1">
    <a href="/equipments" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
    <i class="fa-solid fa-list fa-lg"></i>
    <span>Equipment liste</span>
    </a>
    </li>
    </ul>
    
    </div>
    </li>
{{----------------------------------------equipements end -----------------------------------}}






{{-----------------------------------------------reservations start----------------------------------------------------}}                           

<li class="relative px-2 py-1" x-data="{ Open : false  }">
    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
    x-on:click="Open = !Open">
    <span
    class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
    <i class="fa-solid fa-store fa-lg"></i>
    <span class="ml-4"> Reservation</span>
    </span>
    <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M15 19l-7-7 7-7" />
    </svg>
    
    <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M19 9l-7 7-7-7" />
    </svg>
    </div>
    
    <div x-show.transition="Open" style="display:none;">
    <ul x-transition:enter="transition-all  ease-in-out duration-300"
    x-transition:enter-start="opacity-25 max-h-0"
    x-transition:enter-end="opacity-100 max-h-xl"
    x-transition:leave="transition-all ease-in-out duration-300"
    x-transition:leave-start="opacity-100 max-h-xl"
    x-transition:leave-end="opacity-0 max-h-0"
    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
    aria-label="submenu">
    
    <li class="px-2 py-1">
    <a href="/reservations/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
        <i class="fa-solid fa-store fa-lg"></i>

    <span>Create Reservation</span>
    </a>
    </li>
    <li class="px-2 py-1">
    <a href="/reservations" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
    <i class="fa-solid fa-list fa-lg"></i>
    <span>Reservation liste</span>
    </a>
    </li>
    </ul>
    
    </div>
    </li>

{{-----------------------------------------------reservation end----------------------------------------------------}}                           




{{-----------------------------------------------roles start----------------------------------------------------}}                           

<li class="relative px-2 py-1" x-data="{ Open : false  }">
    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
    x-on:click="Open = !Open">
    <span
    class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
    <i class="fa-solid fa-lock fa-lg"></i>
    <span class="ml-4"> Roles</span>
    </span>
    <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M15 19l-7-7 7-7" />
    </svg>
    
    <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M19 9l-7 7-7-7" />
    </svg>
    </div>
    
    <div x-show.transition="Open" style="display:none;">
    <ul x-transition:enter="transition-all  ease-in-out duration-300"
    x-transition:enter-start="opacity-25 max-h-0"
    x-transition:enter-end="opacity-100 max-h-xl"
    x-transition:leave="transition-all ease-in-out duration-300"
    x-transition:leave-start="opacity-100 max-h-xl"
    x-transition:leave-end="opacity-0 max-h-0"
    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
    aria-label="submenu">
    
    <li class="px-2 py-1">
    <a href="/roles/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
        <i class="fa-solid fa-lock fa-lg"></i>

    <span>Create Roles</span>
    </a>
    </li>
    <li class="px-2 py-1">
    <a href="/roles" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
    <i class="fa-solid fa-list fa-lg"></i>
    <span>Roles liste</span>
    </a>
    </li>
    </ul>
    
    </div>
    </li>

{{-----------------------------------------------roles end----------------------------------------------------}}                           


@endif

{{------------------------------------user reservation start-------------------------------------------------------------------}}

<li class="relative px-2 py-1" x-data="{ Open : false  }">
    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
    x-on:click="Open = !Open">
    <span
    class="inline-flex items-center      text-sm font-semibold text-white hover:text-green-400">
    <i class="fa-solid fa-store fa-lg"></i>
    <span class="ml-4"> Reservation</span>
    </span>
    <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M15 19l-7-7 7-7" />
    </svg>
    
    <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
    class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
    stroke="currentColor" style="display: none;">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M19 9l-7 7-7-7" />
    </svg>
    </div>
    
    <div x-show.transition="Open" style="display:none;">
    <ul x-transition:enter="transition-all  ease-in-out duration-300"
    x-transition:enter-start="opacity-25 max-h-0"
    x-transition:enter-end="opacity-100 max-h-xl"
    x-transition:leave="transition-all ease-in-out duration-300"
    x-transition:leave-start="opacity-100 max-h-xl"
    x-transition:leave-end="opacity-0 max-h-0"
    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium rounded-md shadow-inner bg-green-400"
    aria-label="submenu">
    
    <li class="px-2 py-1">
    <a href="/reservations/create" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
        <i class="fa-solid fa-store fa-lg"></i>

    <span>Create Reservation</span>
    </a>
    </li>
    <li class="px-2 py-1">
    <a href="{{ route('reservations.user') }}" class="flex items-center space-x-2 text-sm font-semibold text-white hover:bg-gray-100 hover:text-gray-800 rounded-md px-2 py-1 transition duration-150">
    <i class="fa-solid fa-list fa-lg"></i>
    <span>My Reservations</span>
    </a>
    </li>
    </ul>
    
    </div>
    </li>

</ul>