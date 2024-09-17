<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.new_user_credentials')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'password' => request()->password, // Or another way to pass the password
            ]);
    }
}
