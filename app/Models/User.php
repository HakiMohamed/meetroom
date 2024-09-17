<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['firstname', 'lastname', 'employeId', 'email', 'password', 'role_id'];

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
        return strtolower($this->role->name) === strtolower($roleName);
    }
    public function isAdmin()
    {
        return strtolower($this->role->name) === 'admin';
    }
    
}
