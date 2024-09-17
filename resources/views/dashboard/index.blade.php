@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-8 text-white dark:text-white">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Total Reservations -->
        <div class="bg-gradient-to-r from-blue-500 to-teal-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Total Reservations</h2>
            <p class="text-4xl font-bold">{{ $totalReservations }}</p>
        </div>

        <!-- Total Rooms -->
        <div class="bg-gradient-to-r from-green-500 to-lime-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Total Rooms</h2>
            <p class="text-4xl font-bold">{{ $totalRooms }}</p>
        </div>

        <!-- Total Equipments -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Total Equipments</h2>
            <p class="text-4xl font-bold">{{ $totalEquipments }}</p>
        </div>

        <!-- Reservations Today -->
        <div class="bg-gradient-to-r from-yellow-500 to-orange-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Reservations Today</h2>
            <p class="text-4xl font-bold">{{ $reservationsToday }}</p>
        </div>

        <!-- Reservations This Week -->
        <div class="bg-gradient-to-r from-red-500 to-rose-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Reservations This Week</h2>
            <p class="text-4xl font-bold">{{ $reservationsThisWeek }}</p>
        </div>

        <!-- Reservations This Month -->
        <div class="bg-gradient-to-r from-indigo-500 to-violet-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Reservations This Month</h2>
            <p class="text-4xl font-bold">{{ $reservationsThisMonth }}</p>
        </div>

        <!-- Finished Reservations -->
        <div class="bg-gradient-to-r from-teal-500 to-cyan-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Finished Reservations</h2>
            <p class="text-4xl font-bold">{{ $finishedReservations }}</p>
        </div>

        <!-- Upcoming Reservations -->
        <div class="bg-gradient-to-r from-pink-500 to-red-400 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold">Upcoming Reservations</h2>
            <p class="text-4xl font-bold">{{ $upcomingReservations }}</p>
        </div>
    </div>

    <!-- Reservations by User -->
    <div class="bg-white dark:bg-gray-800 p-6 mt-8 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Reservations by User</h2>
        <ul class="mt-4 space-y-2">
            @foreach ($reservationsByUser as $user => $count)
                <li class="text-gray-900 dark:text-gray-100 flex justify-between">
                    <span class="font-bold">{{ $user }}:</span> 
                    <span>{{ $count }} reservations</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Room Utilization -->
    <div class="bg-white dark:bg-gray-800 p-6 mt-8 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Room Utilization</h2>
        <ul class="mt-4 space-y-2">
            @foreach ($roomUtilization as $room)
                <li class="text-gray-900 dark:text-gray-100 flex justify-between">
                    <span class="font-bold">{{ $room['room'] }}:</span> 
                    <span>{{ $room['utilization'] }} / {{ $room['total'] }} ({{ number_format(($room['utilization'] / $room['total']) * 100, 2) }}%)</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Reservations Overview Chart -->
    <div class="bg-white dark:bg-gray-800 p-6 mt-8 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Reservations Overview</h2>
        <canvas id="reservationsChart" class="mt-4"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('reservationsChart').getContext('2d');
        var reservationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today', 'This Week', 'This Month', 'Total Reservations'],
                datasets: [{
                    label: 'Reservations',
                    data: [
                        {{ $reservationsToday }},
                        {{ $reservationsThisWeek }},
                        {{ $reservationsThisMonth }},
                        {{ $totalReservations }}
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
