<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendPinEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The User instance.
     *
     * @var \App\Models\User
     */
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pin = $this->user->userPin()->first()->code;
        return $this->subject('Verify PIN')->markdown('emails.pin',[
            'pin' => $this->user->userPin()->first()->code,
            'url' => route('email/verify/'.$this->user->id)
        ]);
    }
}
