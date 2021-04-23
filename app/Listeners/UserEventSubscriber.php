<?php
namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user created events.
     */
    public function onUserSignup($event)
    {
        Mail::to($event->user->email)->send(new InvitationEmail($event->user));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'eloquent.created: App\Models\Users',
            [UserEventSubscriber::class, 'onUserSignup']
        );
    }
}