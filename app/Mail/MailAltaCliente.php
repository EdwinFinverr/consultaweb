<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Beneficiarios;
use App\Contrato_inversion;
use App\DatosUsuario;
use App\Beneficiario_inversion;
use App\Empresa_inversion;
use App\Estado_inversion;
use App\Http\Requests\AlmacenarBeneficiario;
use App\InversionCliente;
use App\photos;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactoMail;
use App\proyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailAltaCliente extends Mailable
{
    use SerializesModels;

    public $user;
    public $passwordTemporal; // Cambiar el nombre de la variable a $passwordTemporal

    public function __construct($user, $passwordTemporal) // Cambiar el nombre del parámetro a $passwordTemporal
    {
        $this->user = $user;
        $this->passwordTemporal = $passwordTemporal; // Asignar el valor a $passwordTemporal
    }

    public function build()
    {
        return $this->view('mailclientealta')
            ->subject('Bienvenido a nuestra plataforma')
            ->with([
                'user' => $this->user,
                'passwordTemporal' => $this->passwordTemporal, // Cambiar el nombre de la variable en el array a 'passwordTemporal'
            ])
            ->withSwiftMessage(function ($message) {
                $message->embed(public_path('img/firma.png'), 'firma');
            });
    }
}
