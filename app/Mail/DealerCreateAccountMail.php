<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DealerCreateAccountMail extends Mailable
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
        $this->details = $details;
        $this->subject = "Nieuw account aanvraag";
        $this->title = "Drostmachinehandel.com";
        $this->details['currentTime'] = date("F j, Y, g:i a");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.dealerCreateAccount', ['details' => $this->details]);
    }
}
