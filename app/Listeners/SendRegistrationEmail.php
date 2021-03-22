<?php

namespace App\Listeners;

use App\Events\RegistrationProccesed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegistration;

class SendRegistrationEmail
{
    public function __construct()
    {
        //
    }

    public function handle(RegistrationProccesed $event)
    {
        Mail::to($event->user->email)->send(new ConfirmRegistration($event->user));
    }
}
