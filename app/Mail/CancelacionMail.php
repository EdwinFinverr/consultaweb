<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\InversionCliente; // Asegúrate de importar el modelo adecuado

class CancelacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inversion; // Variable para almacenar la inversión

    /**
     * Create a new message instance.
     */
    public function __construct(InversionCliente $inversion)
    {
        $this->inversion = $inversion; // Asignar la inversión al correo
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cancelación del proceso',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailcancelacion', // Vista para el correo
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
