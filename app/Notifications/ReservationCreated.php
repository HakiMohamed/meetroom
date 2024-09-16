<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCreated extends Notification
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
                    ->subject('Nouvelle Réunion Réservée')
                    ->greeting('Bonjour,')
                    ->line('Une nouvelle réunion a été réservée.')
                    ->line('Détails de la réunion:')
                    ->line('Salle : ' . $reservation->room->name)
                    ->line('Sujet : ' . $reservation->subject)
                    ->line('Début : ' . $reservation->start_time)
                    ->line('Fin : ' . $reservation->end_time)
                    ->line('Participants : ' . implode(', ', $reservation->participants))
                    ->action('Voir les détails', url('/reservations/'.$reservation->id));
    }
}
