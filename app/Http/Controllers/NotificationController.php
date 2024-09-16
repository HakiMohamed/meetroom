<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MeetingReminder;

class NotificationController extends Controller
{
    // Envoie un rappel pour les réunions à venir
    public function sendReminders()
    {
        $upcomingReservations = Reservation::where('start_time', '>', now())
            ->where('start_time', '<=', now()->addMinutes(45))
            ->where('status', 'encours')
            ->get();

        foreach ($upcomingReservations as $reservation) {
            $participantsEmails = explode(',', $reservation->participants);
            $meetingLink = $reservation->getMeetingLink();
            
            Notification::route('mail', $participantsEmails)->notify(new MeetingReminder($reservation, $meetingLink));
            $reservation->user->notify(new MeetingReminder($reservation, $meetingLink));
        }

        return 'Reminders sent successfully!';
    }
}
