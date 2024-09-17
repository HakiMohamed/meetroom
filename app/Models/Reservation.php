<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Reservation extends Model
{
    protected $fillable = [
        'room_id', 'user_id', 'meeting_type', 'platform',
        'start_time', 'end_time', 'subject', 'participants', 'status',
    ];

    protected $dates = ['start_time', 'end_time'];

    public function room()
    {
        return $this->belongsTo(ReunionsRoom::class, 'room_id');
    }
    


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipement::class, 'reservation_equipement');
    }

    public function isActive()
    {
        return $this->status === 'encours';
    }

    public function isFinished()
    {
        return $this->status === 'finished';
    }

    public function getDurationAttribute()
    {
        return $this->end_time->diffInMinutes($this->start_time);
    }

    public function exceedsMaxDuration()
    {
        return $this->getDurationAttribute() > 120;
    }
}
