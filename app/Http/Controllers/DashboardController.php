<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Equipement;
use App\Models\ReunionsRoom;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics for the dashboard
        $totalReservations = Reservation::count();
        $totalRooms = ReunionsRoom::count();
        $totalEquipments = Equipement::count();
        $reservationsToday = Reservation::whereDate('start_time', Carbon::today())->count();
        $reservationsThisWeek = Reservation::whereBetween('start_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $reservationsThisMonth = Reservation::whereMonth('start_time', Carbon::now()->month)->count();
        $finishedReservations = Reservation::where('status', 'finished')->count();
        $upcomingReservations = Reservation::where('start_time', '>', Carbon::now())->whereDate('start_time', '<=', Carbon::now()->addDays(7))->count();

        // Reservations by User
        $reservationsByUser = Reservation::select('user_id', \DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->with('user')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->user->fullname => $item->total];
            });

        // Room Utilization
        $roomUtilization = ReunionsRoom::withCount(['reservations' => function($query) {
            $query->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now());
        }])->get()->map(function ($room) {
            return [
                'room' => $room->name,
                'utilization' => $room->reservations_count,
                'total' => $room->capacity
            ];
        });

        return view('dashboard.index', compact(
            'totalReservations',
            'totalRooms',
            'totalEquipments',
            'reservationsToday',
            'reservationsThisWeek',
            'reservationsThisMonth',
            'finishedReservations',
            'upcomingReservations',
            'reservationsByUser',
            'roomUtilization'
        ));
    }
}
