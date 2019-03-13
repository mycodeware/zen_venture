<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $requests;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requests)
    {
        $this->requests = $requests;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('['.config('app.name').'] Notification of Match Request')
            ->view('mails.request')
            ->with(['requests' => $this->requests]);
    }
}
