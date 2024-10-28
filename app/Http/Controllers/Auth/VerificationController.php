<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Models\User;
use App\Models\DatosUsuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    // Redirección después de la verificación exitosa
    protected $redirectTo = '/registro/lobby';

    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware para verificar la autenticación y firmado de URL
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        // Middleware para limitar la tasa de solicitudes
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mostrar la vista de verificación de correo electrónico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('correo', [
                'pageTitle' => __('Account Verification')
            ]);
    }

    /**
     * Verificar el correo electrónico del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function verify(EmailVerificationRequest $request)
     {
         if ($request->user()->hasVerifiedEmail()) {
             return redirect()->route('login');
         }
     
         if ($request->user()->markEmailAsVerified()) {
             event(new Verified($request->user()));
         }
     
         // Obtener el rol del usuario
         $role = $request->user()->role;
     
         // Verificar si el usuario tiene un RFC registrado
         $datos = DatosUsuario::where('user_id', $request->user()->id)->first();
     
         // Redirigir según el rol del usuario
         switch ($role) {
             case 2:
                 if ($datos && empty($datos->rfc)) {
                     return redirect()->route('actualizar', ['id' => $request->user()->id]);
                 } else {
                     return redirect()->route('lobby');
                 }
                 break;
             case 3:
                 return redirect()->route('actualizarase', ['id' => $request->user()->id]);
                 break;
             default:
                 // Redirección predeterminada para roles no especificados
                 return redirect()->route('defaultRoute');
                 break;
         }
     }
     



    /**
     * Reenviar el correo de verificación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}