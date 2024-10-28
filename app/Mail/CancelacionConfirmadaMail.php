<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CancelacionConfirmadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->view('cancelacionconfirmada')
                    ->subject('Confirmación de Cancelación')
                    ->attach($this->pdfPath, [
                        'as' => 'ConvenioCancelacion.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
