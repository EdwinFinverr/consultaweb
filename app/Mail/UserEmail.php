<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
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
        return $this->view('mailcontrato')
                    ->subject('Firma Digital')
                    ->attach($this->pdfPath, [
                        'as' => 'Precontrato.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
