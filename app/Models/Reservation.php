<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MeetingReminder;

class Reservation extends Model
{
    protected $fillable = [
        'RoomId', 'UserId', 'meeting_type', 'platform', 
        'start_time', 'end_time', 'subject', 'participants', 'status'
    ];

    protected $dates = ['start_time', 'end_time'];

    public function room()
    {
        return $this->belongsTo(ReunionsRoom::class, 'RoomId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }

    public function equipements()
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

    public function sendMeetingReminder()
    {
        // Convert the participants string to an array if it's a comma-separated list
        $participants = explode(',', $this->participants);
        
        // Send notification to each participant
        foreach ($participants as $email) {
            Notification::route('mail', trim($email))
                ->notify(new MeetingReminder($this));
        }
    }
}

