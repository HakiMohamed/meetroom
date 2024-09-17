<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Reservation Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>


<style>

     /* Animation pour l'agrandissement */
     @keyframes scale-up {
        from {
            transform: scale(1);
        }
        to {
            transform: scale(1.1);
        }
    }

    /* Animation pour la couleur de fond */
    @keyframes background-color {
        from {
            background-color: #ffffff; /* blanc */
        }
        to {
            background-color: #e5e7eb; /* gris clair */
        }
    }
</style>
 
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
<!-- Header -->
<nav class="bg-gray-800 border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="block text-center text-white text-3xl font-bold">Room<span class="text-blue-400">Meet</span></span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-gray-800 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                <li class="mb-5 md:mb-0">
                    <a href="#features" class="text-white hover:text-gray-400 px-4 font-semibold transition">
                        <i class="fas fa-cogs mr-2"></i> Features
                    </a>
                </li>
                
                @if (Auth::check() && Auth::user()->hasRole('employe'))
                <li class="mb-5 md:mb-0">
                    <a href="/reservations/create" class="text-white hover:text-gray-400 px-4 font-semibold transition">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                </li>
                @endif

                @if (Auth::check() && Auth::user()->hasRole('admin'))
                <li class="mb-5 md:mb-0">
                    <a href="/dashboard" class="text-white hover:text-gray-400 px-4 font-semibold transition">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                </li>
                @endif

                <li class="mb-5 md:mb-0">
                    <a href="#contact" class="text-white hover:text-gray-400 px-4 font-semibold transition">
                        <i class="fas fa-envelope mr-2"></i> Contact
                    </a>
                </li>

                @if (Auth::check())
                <li class="mb-5 md:mb-0">
                    <!-- Logout Link with Icon and Modern Styling -->
                    <a href="/logout" class="bg-red-500 text-white py-2 px-4 rounded-lg font-semibold flex items-center hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </li>
                @else
                <li class="mb-5 md:mb-0">
                    <!-- Login Link with Icon and Modern Styling -->
                    <a href="/login" class="bg-green-500 text-white py-2 px-4 rounded-lg font-semibold flex items-center hover:bg-green-600 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>



    <!-- Introduction Section -->
    <section class="bg-gray-700 text-white py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Welcome to our reservation platform</h2>
            <p class="text-lg mb-6">Easily book meeting rooms, whether for virtual or in-person meetings. Simplify your meeting management with our secure and user-friendly system.</p>
       
            @if (Auth::check())
    <!-- Link for authenticated users -->
    <a href="/reservations/create" class="bg-white text-gray-700 py-2 px-6 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg hover:scale-105 animate-scale-up">
        Get Started
    </a>
@else
    <!-- Link for non-authenticated users -->
    <a href="/login" class="bg-white text-gray-700 py-2 px-6 rounded-lg font-semibold transition-all duration-300 ease-in-out hover:bg-gray-200 hover:shadow-lg hover:scale-105 animate-scale-up">
        Get Started
    </a>
@endif

        

        </div>

        <div id="default-carousel" class="relative w-full my-5" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/image1.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Descriptive Alt Text">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/image2.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Descriptive Alt Text">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/image3.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Descriptive Alt Text">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/image4.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Descriptive Alt Text">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/image5.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Descriptive Alt Text">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Main Features</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Meeting Reservations</h3>
                    <p>Choose between virtual meetings with platforms like Google Meet or Microsoft Teams, or book a room for in-person meetings.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Equipment Management</h3>
                    <p>Book the necessary equipment for your in-person meetings, with real-time availability checks.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Notifications</h3>
                    <p>Receive email confirmations and reminders for each reservation, so you never miss an important meeting.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Easy Cancellation</h3>
                    <p>Easily cancel your reservations, provided it's done at least 48 hours in advance.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">User Dashboard</h3>
                    <p>View your past and upcoming reservations with an intuitive and secure user interface.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Administrative Management</h3>
                    <p>Administrators can manage users, rooms, and equipment, with access to a global reservation calendar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Contact Us</h2>
            <p class="text-lg mb-6">For any questions or demo requests, feel free to reach out to us.</p>
            <a href="mailto:meetroom.pro@gmail.com" class="bg-white text-gray-700 py-2 px-6 rounded-lg font-semibold hover:bg-gray-200">Send an Email</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; 2024 Meetroom. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</body>
</html>
