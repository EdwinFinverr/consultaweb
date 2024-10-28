<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProcesoInversionMail extends Mailable
{
    use SerializesModels;

    public $userName;
    public $lastName;

    public function __construct($userName, $lastName)
    {
        $this->userName = $userName;
        $this->lastName = $lastName;
    }

    public function build()
    {
        return $this->view('mailproceso');
    }
}
