<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $fillable = ['name'];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_equipement');
    }

    public function isReserved($startTime, $endTime)
    {
        return $this->reservations()
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
            })->exists();
    }
}
