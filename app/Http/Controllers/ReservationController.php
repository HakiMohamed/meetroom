<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReunionsRoom;
use App\Models\Equipement;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MeetingReminder;

class ReservationController extends Controller
{
    // Affiche le formulaire de réservation
    public function create()
    {
        $rooms = ReunionsRoom::all();
        $equipements = Equipement::all();
        return view('reservations.create', compact('rooms', 'equipements'));
    }

    // Enregistre une nouvelle réservation
    public function store(Request $request)
    {
        $request->validate([
            'RoomId' => 'required|exists:reunions_rooms,id',
            'meeting_type' => 'required|in:virtual,in-person',
            'platform' => 'required_if:meeting_type,virtual',
            'equipements' => 'array',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'subject' => 'required|string',
            'participants' => 'required|string',
        ]);

        $room = ReunionsRoom::findOrFail($request->input('RoomId'));
        $equipements = $request->input('equipements', []);

        // Check if room or equipment is already reserved
        if (!$room->isAvailable($request->input('start_time'), $request->input('end_time'))) {
            return redirect()->back()->withErrors(['Room is already reserved during this time']);
        }

        $reservedEquipements = [];
        foreach ($equipements as $equipementId) {
            $equipement = Equipement::findOrFail($equipementId);
            if (!$equipement->isAvailable($request->input('start_time'), $request->input('end_time'))) {
                $reservedEquipements[] = $equipement->name;
            }
        }

        if (!empty($reservedEquipements)) {
            return redirect()->back()->withErrors([
                'The following equipment(s) are already reserved during this time: ' . implode(', ', $reservedEquipements)
            ]);
        }

        // Create reservation
        $reservation = Reservation::create([
            'RoomId' => $request->input('RoomId'),
            'UserId' => auth()->id(),
            'meeting_type' => $request->input('meeting_type'),
            'platform' => $request->input('platform'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'subject' => $request->input('subject'),
            'participants' => $request->input('participants'),
            'status' => 'encours',
        ]);

        $reservation->equipements()->sync($equipements);

        $participantsEmails = explode(',', $request->input('participants'));
        $meetingLink = $reservation->getMeetingLink();

        Notification::route('mail', $participantsEmails)->notify(new MeetingReminder($reservation, $meetingLink));
        $reservation->user->notify(new MeetingReminder($reservation, $meetingLink));

        return redirect()->route('reservations.index')->with('status', 'Reservation created successfully!');
    }

    // Affiche toutes les réservations de l'utilisateur
    public function index()
    {
        $reservations = Reservation::where('UserId', auth()->id())->get();
        return view('reservations.index', compact('reservations'));
    }

    // Affiche les détails d'une réservation
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    // Annule une réservation
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('status', 'Reservation cancelled successfully!');
    }
}
