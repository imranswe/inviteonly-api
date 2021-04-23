<?php

namespace App\Listeners;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SendPinEmail;
use App\Events\UserSignupEvent;

class UserSignupEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserSignupEvent $event)
    {
        Mail::to($event->user->email)->send(new SendPinEmail($event->user));
    }
}
