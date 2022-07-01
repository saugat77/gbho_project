<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
<<<<<<< HEAD
        return $this->from(env('MAIL_FROM'))->subject('Test Email')->markdown('email.test');
=======
        return $this->subject('Test Email')->markdown('email.test');
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
    }
}
