<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OccasionsReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $details;
    public $subject;
    public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->subject = "Reservering bevestigingsmail: " . $details["vehicle"];
        $this->title = "Reservering bevestiging";
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.occasionsReservation', ['details' => $this->details]);
    }
}
