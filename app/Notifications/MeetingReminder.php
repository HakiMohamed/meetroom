<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingReminder extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $reservation = $this->reservation;

        return (new MailMessage)
            ->subject('Rappel de Réunion')
            ->greeting('Bonjour,')
            ->line('Votre réunion commence dans 45 minutes.')
            ->line('Détails de la réunion:')
            ->line('Salle : '.$reservation->room->name)
            ->line('Sujet : '.$reservation->subject)
            ->line('Début : '.$reservation->start_time)
            ->line('Fin : '.$reservation->end_time)
            ->action('Voir les détails', url('/reservations/'.$reservation->id));
    }
}
