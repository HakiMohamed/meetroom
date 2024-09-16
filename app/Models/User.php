<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['firstname', 'lastname', 'EmployeId', 'email', 'password', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'UserId');
    }

    public function hasRole($roleName)
    {
        return $this->role->name === $roleName;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public static function findForPassport($identifier)
    {
        return static::where('email', $identifier)
            ->orWhere('EmployeId', $identifier)
            ->first();
    }
}
