<?php

namespace App\Observers;

use Mail;
use App\Models\Invitation;
use App\Mail\InvitationEmail;

class InvitationObserver
{
    /**
     * Listen to the Invitation creating event.
     *
     * @param  Invitation  $invite
     * @return void
     */
    public function creating(Invitation $invitation)
    {
        $invitation->token = $invitation->generateToken();
    }

    /**
     * Handle the Invitation "created" event.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return void
     */
    public function created(Invitation $invitation)
    {
        Mail::to($invitation->email)->send(new InvitationEmail($invitation));
    }

    /**
     * Handle the Invitation "updated" event.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return void
     */
    public function updated(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the Invitation "deleted" event.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return void
     */
    public function deleted(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the Invitation "restored" event.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return void
     */
    public function restored(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the Invitation "force deleted" event.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return void
     */
    public function forceDeleted(Invitation $invitation)
    {
        //
    }
}
