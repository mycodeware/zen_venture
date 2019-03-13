<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationIdentifyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.config('app.name').'] Notification of Identify Request')
            ->view('mails.identify')
            ->with(['users' => $this->users]);
    }
}
