<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReunionsRoom extends Model
{
    protected $fillable = ['name', 'capacity', 'location'];

    public function reservations()
{
    return $this->hasMany(Reservation::class, 'room_id');
}


    public function isAvailable($startTime, $endTime)
    {
        return ! $this->reservations()
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })->exists();
    }
}
