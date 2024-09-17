<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class UpdateReservationStatus extends Command
{
    protected $signature = 'reservations:update-status';
    protected $description = 'Update reservation status to finished if the end time has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all reservations where the end time has passed and status is not 'finished'
        $reservations = Reservation::where('end_time', '<', Carbon::now())
                                   ->where('status', '<>', 'finished')
                                   ->get();

        foreach ($reservations as $reservation) {
            $reservation->update(['status' => 'finished']);
            $this->info("Updated reservation ID {$reservation->id} to 'finished'.");
        }
    }
}
