<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DriverCodeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Mail Successfully Generated - Milk-Kitchen')
            ->view('mail.driverCodeMail');
    }
}
