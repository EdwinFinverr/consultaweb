<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DatosUsuario;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithEmailToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener el token del correo electrónico
        $token = $request->query('token');

        // Buscar el usuario con el token proporcionado en la tabla DatosUsuario
        $user = DatosUsuario::where('email_token', $token)->first();

        if ($user) {
            // Autenticar al usuario
            Auth::login($user);

            // Continuar con la solicitud
            return $next($request);
        }

        // Si no se encuentra el usuario, redirigir a una página de error o a donde prefieras
        return redirect()->route('error');
    }
}
