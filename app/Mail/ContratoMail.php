<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContratoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_id;
    public $pdfPath;

    public function __construct($user_id, $pdfPath)
    {
        $this->user_id = $user_id;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->view('mailcontratofinal')
                    ->subject('Contrato')
                    ->attach($this->pdfPath, [
                        'as' => 'Contrato.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->withSwiftMessage(function ($message) {
                        $message->embed(public_path('img/firma.png'), 'firma');
                    });
    }
}
