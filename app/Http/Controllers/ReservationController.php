<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Equipement;
use App\Models\ReunionsRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use App\Jobs\SendReservationEmail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room', 'user', 'equipments')->paginate(10);
        return view('reservations.index', compact('reservations'));
    }



    public function edit(Reservation $reservation)
    {
        $rooms = ReunionsRoom::all();
        $equipments = Equipement::all();
        return view('reservations.edit', compact('reservation', 'rooms', 'equipments'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->equipments()->detach();
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }


    public function userReservations()
    {
        // Fetch reservations for the logged-in user
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room', 'equipments')
            ->paginate(10);

        return view('reservations.user_reservations', compact('reservations'));
    }



    

    public function cancel(Reservation $reservation)
    {
        // Check if the authenticated user is the creator of the reservation
        if (Auth::id() !== $reservation->user_id) {
            return redirect()->route('reservations.index')->with('error', 'You are not authorized to cancel this reservation.');
        }
    
        // Convert start_time to a Carbon instance
        $start_time = Carbon::parse($reservation->start_time);
    
        // Ensure the cancellation is made at least 48 hours before the start time
        if ($start_time->diffInHours(now()) < 48) {
            return redirect()->route('reservations.index')->with('error', 'You can only cancel reservations at least 48 hours before the start time.');
        }
    
        // Detach associated equipment
        $reservation->equipments()->detach();
        
        // Delete the reservation
        $reservation->status = "cancelled";
        $reservation->save();
    
        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }
    





    public function create()
    {
        $rooms = ReunionsRoom::all();
        $equipments = Equipement::all();
        return view('reservations.create', compact('rooms', 'equipments'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('room', 'user', 'equipments');
        return view('reservations.show', compact('reservation'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:reunions_rooms,id',
            'meeting_type' => 'required|in:virtual,in-person',
            'platform' => 'nullable|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'subject' => 'nullable|string',
            'participants' => 'nullable|string', // Ensure participants is a string
            'equipments' => 'nullable|array',
            'equipments.*' => 'exists:equipements,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check room availability
        $room = ReunionsRoom::find($request->room_id);
        if ($room->reservations()->where(function ($query) use ($request) {
            $query->where('start_time', '<', $request->end_time)
                  ->where('end_time', '>', $request->start_time);
        })->exists()) {
            return back()->withErrors(['room_id' => 'The selected room is not available during the selected time.']);
        }

        // Split and validate participants
        $participants = array_filter(array_map('trim', explode(',', $request->participants)));

        // Check equipment availability
        $equipments = Equipement::find($request->equipments ?? []);
        $unavailableEquipments = [];
        foreach ($equipments as $equipment) {
            if ($equipment->isReserved($request->start_time, $request->end_time)) {
                $unavailableEquipments[] = $equipment->name;
            }
        }

        if (!empty($unavailableEquipments)) {
            $unavailableEquipmentsList = implode(', ', $unavailableEquipments);
            return back()->withErrors(['equipments' => "The following equipment(s) are not available: $unavailableEquipmentsList."]);
        }

        // Create reservation
        $reservation = Reservation::create([
            'room_id' => $request->room_id,
            'user_id' => Auth::id(),
            'meeting_type' => $request->meeting_type,
            'platform' => $request->platform,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'subject' => $request->subject,
            'participants' => json_encode($participants), // Save as JSON
            'status' => 'encours',
        ]);

        // Attach equipment
        if ($request->has('equipments')) {
            $reservation->equipments()->attach($request->equipments);
        }

        // Send emails
        $this->sendEmails($reservation, $participants);

        return redirect()->back()->with('success', 'Reservation created successfully.');
    }

    public function sendEmails(Reservation $reservation, array $participants)
    {
        // Send email to the creator first
        SendReservationEmail::dispatch($reservation, $reservation->user->email);

        // Send email to each participant
        foreach ($participants as $index => $participantEmail) {
            Log::info('Dispatching email to participant: ' . $participantEmail);
            SendReservationEmail::dispatch($reservation, $participantEmail)
                ->delay(now()->addSeconds(30 * ($index + 1)));
        }
    }
}
