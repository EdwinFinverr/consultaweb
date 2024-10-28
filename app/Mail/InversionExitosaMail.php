<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InversionExitosaMail extends Mailable
{

    public function build()
    {
        return $this->view('mailinversionexitosa')
                    ->subject('Inversión Exitosa')
                    ->withSwiftMessage(function ($message) {
                        $message->embed(public_path('img/firma.png'), 'firma');
                    });
    }
}