<?php

namespace App\Console;

use App\Models\Reservation;
use App\Notifications\MeetingReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $upcomingReservations = Reservation::where('start_time', '>', now())
                ->where('start_time', '<=', now()->addMinutes(45))
                ->where('status', 'encours')
                ->get();
    
            foreach ($upcomingReservations as $reservation) {
                $participantsEmails = explode(',', $reservation->participants);
                Notification::route('mail', $participantsEmails)->notify(new MeetingReminder($reservation));
                $reservation->user->notify(new MeetingReminder($reservation));
            }
        })->everyFiveMinutes();  // Vérifier toutes les 5 minutes
    }
    

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
