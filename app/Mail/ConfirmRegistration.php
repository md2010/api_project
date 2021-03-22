<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmRegistration extends Mailable
{
    use Queueable, SerializesModels;
    	
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emailRegistration')
            ->from('info@example.com', 'Info')
            ->subject('Verify Email')
            ->with('user', $this->user);
    }
}
