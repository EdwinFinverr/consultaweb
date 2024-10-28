<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario_inversion;
use Illuminate\Http\Request;
use App\Models\Beneficiarios;
use App\Models\Contrato_inversion;
use App\Models\DatosUsuario;
use App\Models\Empresa_inversion;
use App\Models\Estado_inversion;
use App\Mail\UserEmail;
use App\Mail\Desaprobado;
use App\Mail\MailAltaCliente;
use App\Http\Requests\AlmacenarBeneficiario;
use App\Models\InversionCliente;
use App\Models\photos;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\MailRegistro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
Use App\Models\Proyecto;
Use App\Models\Banco;
Use App\Models\Procedencia;

class AsesorController extends Controller
{
    public function index(Request $request)
    {


        if ($request) {
            $query = trim($request->get('search'));
            $userid = Auth::user()->id;
            $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->where('asesor_id', $userid)
                ->paginate(5);
            return view('informacioncliente', ['usuarios' => $users, 'search' => $query]);
        }

            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }
    public function indexinicio(Request $request)
    {
         $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('user_id', $userid)
                ->paginate(15);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::all();
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            return view('inc/navphotos')->with('usuarios',$users);

            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }

    // public function getBeneficiario($id)
    // {
    //     $userid = Auth::user()->id;
    //         $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
    //         $inversionesActivas = InversionCliente::obtener($userid, 1);
    //         $inversionesPendientes = InversionCliente::obtener($userid, 2);
    //         $inversionesTerminadas = InversionCliente::obtener($userid, 3);
    //         $datos = DatosUsuario::where('user_id', $userid)->get();
    //         return view('controlCliente', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
    // }


    public function aprobar(Request $request, $id) {
        $estatus = DatosUsuario::find($id);
        $estatus->estado_fotos = '1';
        $estatus->save();
    
        $user = DatosUsuario::find($id);
    
        if ($user) {
            // Generar el contrato PDF
            $filename = $this->generarContratoPDF($user->user_id);
    
            // Obtener la ruta completa del archivo PDF
            $pdfPath = public_path($filename); // Usar public_path() para obtener la ruta pública del archivo PDF
    
            // Enviar el correo electrónico con el PDF adjunto
            Mail::to($user)->send(new UserEmail($user->user_id, $pdfPath));
    
            // Actualizar el campo pre_folio_estado de la última inversión del usuario
            $ultimaInversion = InversionCliente::where('user_id', $user->user_id)
            ->latest('created_at')->first();
    
            if ($ultimaInversion) {
                $ultimaInversion->pre_folio_estado = null;
                $ultimaInversion->save();
            }
    
            return redirect()->route('clienteadmin')->with("success","Validacion Actualizada")->with('user_id', $user->user_id); // Pasar el user_id a la vista
        }
    
        return redirect()->route('clienteadmin')->with("success","El correo no existe");
    }
    
    
    public function generarContratoPDF($userid) {
        // Obtener la inversión más reciente de la base de datos
        $inversionDB = InversionCliente::where('user_id', $userid)->latest()->first();
    
        // Obtener la inversión de la sesión
        $inversionSesion = session()->get('inversion');
    
        // Combinar ambas inversiones usando el operador de fusión de null
        $inversion = $inversionDB ?? $inversionSesion;
        $proyecto = Proyecto::all();
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $user = User::where('users.id', $userid)
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $clabe = substr($inversion->cuenta_transferencia, 0, 3);
        $banco = Banco::where('clave', $clabe)->first();
        $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
    
        // Limpiar el número de cualquier carácter no numérico
        $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);
    
        // Convertir el monto a letras
        $montoLetras = $this->convertirNumeroALetras($montoNumerico);
    
        // Obtener el texto de procedencia guardado
        $procedencias = Procedencia::where('id_user', $userid)
            ->where('id_inversion', $inversion->id)
            ->get();
    
            $textoProcedenciaStr = '';

            foreach ($procedencias as $procedencia) {
                if ($procedencia->intitucion == 'Depósito Bancario') {
                    $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Institución: {$procedencia->intitucion}</li>";
                } else {
                    $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Cuenta Clabe: {$procedencia->cuentaclabe}, Institución: {$procedencia->intitucion}</li>";
                }
            }
    
        // Lógica condicional para determinar qué vista cargar
        $viewName = 'contratos.inversionV2';
    
        // Cargar la vista correcta
        $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras', 'textoProcedenciaStr'));
    
        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'Pre Contrato' . $nombreCliente . $folioContrato . '.pdf';
    
        // Guardar el PDF en el directorio public/contratos
        $pdf->save(public_path('contratos/' . $filename));
    
        // Devolver la ruta relativa del archivo
        return 'contratos/' . $filename;
    }
    

    public function convertirNumeroALetras($numero) {
        // Arreglos con las palabras en español para los números
        $unidad = array('', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve');
        $decena = array('diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve');
        $decenas = array('', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa');
        $centenas = array('', 'cien', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos');
        
        // Formatear el número para asegurar que tenga dos decimales
        $numero = number_format($numero, 2, '.', '');
        $partes = explode('.', $numero);
        $entero = (int) $partes[0];
        $decimal = isset($partes[1]) ? $partes[1] : '00';
        
        // Convertir la parte entera a letras
        $cadena = $this->convertirNumeroALetrasParteEntera($entero);
        
        // Añadir "PESOS" y los centavos al final
        $cadena .= ' PESOS ' . str_pad($decimal, 2, '0', STR_PAD_LEFT) . '/100 M.N.';
        
        return strtoupper($cadena);
    }
    
    public function convertirNumeroALetrasParteEntera($entero) {
        // Arreglos con las palabras en español para los números
        $unidad = array('', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve');
        $decena = array('diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve');
        $decenas = array('', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa');
        $centenas = array('', 'cien', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos');
    
        // Cadena donde se irá acumulando la conversión a letras
        $cadena = '';
    
        // Convertir números mayores a 999,999 (un millón)
        if ($entero >= 1000000) {
            $millones = floor($entero / 1000000);
            if ($millones == 1) {
                $cadena .= 'UN MILLÓN';
            } else {
                $cadena .= $this->convertirNumeroALetrasParteEntera($millones) . ' MILLONES';
            }
            $entero = $entero % 1000000;
            if ($entero > 0) {
                $cadena .= ' DE ' . $this->convertirNumeroALetrasParteEntera($entero);
            }
        }
        // Convertir números entre 1000 y 999,999
        elseif ($entero >= 1000) {
            $miles = floor($entero / 1000);
            $cadena .= $this->convertirNumeroALetrasParteEntera($miles) . ' MIL';
            $entero = $entero % 1000;
            if ($entero > 0) {
                $cadena .= ' ' . $this->convertirNumeroALetrasParteEntera($entero);
            }
        }
        // Convertir números entre 100 y 999
        elseif ($entero >= 100) {
            $centenasIndex = floor($entero / 100);
            $cadena .= $centenas[$centenasIndex];
            $entero = $entero % 100;
            if ($entero > 0) {
                $cadena .= ' ' . $this->convertirNumeroALetrasParteEntera($entero);
            }
        }
        // Convertir números entre 20 y 99
        elseif ($entero >= 20) {
            $decenasIndex = floor($entero / 10);
            $cadena .= $decenas[$decenasIndex];
            $entero = $entero % 10;
            if ($entero > 0) {
                $cadena .= ' Y ' . $unidad[$entero];
            }
        }
        // Convertir números entre 10 y 19
        elseif ($entero >= 10) {
            $cadena .= $decena[$entero - 10];
        }
        // Convertir números entre 1 y 9
        else {
            $cadena .= $unidad[$entero];
        }
    
        return $cadena;
    }
    
    
    
    
    
    public function sendEmailToUser($userId)
    {

        $user = DatosUsuario::find($userId);
        if ($user) {
            Mail::to($user)->send(new UserEmail());
            return response()->json(['message' => 'Correo electrónico enviado correctamente.']);
        }
        return response()->json(['message' => 'Usuario no encontrado.']);
    }


    public function desaprobar(Request $request, $id){
        $estatus = DatosUsuario::find($id);
        $estatus->estado_fotos = '2';
        $estatus->save();
        $user = DatosUsuario::find($id);
        $comments = $request->input('comments');
        $reason = $request->input('reason'); // Obtener el valor seleccionado del campo select
        Mail::to($user->email)->send(new Desaprobado($comments, $reason)); // Pasar el valor al correo
        return redirect()->route('clienteadmin')->with("success","Validacion Actualizada");
    }


    public function activa(Request $request, $id){
        $estatus = DatosUsuario::find($id);
        $estatus->estado_fotos = '3';
        $estatus->save();

        return redirect()->route('clienteadmin')->with("success","Validacion Actualizada");
    }



    public function indexinversion($id )
    {
        $inversiones = InversionCliente::where('user_id', $id)->get();
        return view('informacioninversiones', ['inversiones' => $inversiones]);
    }




    public function i( )
    {
        $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('asesor_id', $userid)
                ->paginate(15);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::all();
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            return view('altaclientease', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }

    public function indexasesor()
    {
        $userid = Auth::user()->id;
        $users = User::all()->where('id', $userid);
            return view('altaclientease')->with('usuarios',$users);
            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }
    public function getGallery($id)
    {
        $fotos = photos::where('user_id', $id)->get();

        return view('documentacionase', ['fotos' => $fotos]);
    }


    public function postRegistrationClienteAsesor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $data = $request->all();
        $passwordTemporal = Str::random(8); // Generar una contraseña temporal de 8 caracteres

        // Crear el usuario y obtener el ID del último registro
        $lastId = $this->createUser($data, $passwordTemporal);

        // Crear los datos adicionales del usuario
        $this->createUserData($data, $lastId);

        // Obtener el usuario creado
        $user = User::find($lastId);

        // Enviar el correo electrónico con los datos del usuario y la contraseña temporal
        Mail::to($user->email)->send(new MailAltaCliente($user, $passwordTemporal));

        return redirect("altaclientease")->withSuccess('Se creó el cliente');
    }

    public function createUser(array $data, string $password)
    {
        $lastId = User::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => '2',
            'clave_asesor' => '',
            'password' => Hash::make($password),
            'password_change_required' => true, // Indicador de cambio de contraseña
        ]);

        $user = User::find($lastId);
        event(new Registered($user));
        return $lastId;
    }


    public function showChangePasswordForm($id)
    {
        $user = User::find($id);

        if (!$user || $user->role != '2') {
            // El usuario no existe o no es un asesor
            abort(404);
        }

        if (!$user->email_verified_at) {
            // El usuario no ha verificado su correo electrónico
            return redirect()->back()->withErrors([
                'message' => 'Por favor, verifique su correo electrónico para poder cambiar la contraseña',
            ]);
        }

        return view('cambiar-contrasena', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::find($request->input('user_id'));

        if (!$user || $user->role != '2') {
            // El usuario no existe o no es un asesor
            abort(404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('lobby')->with('passwordChanged', true);
    }
    public function createUserData(array $data, int $lastId)
    {
        $userid = Auth::user()->id;
        return DatosUsuario::create([
            'user_id' => $lastId,
            'lastName' => $data['lastName'],
            'address' => '',
            'email' => $data['email'],
            'postalcode' => '',
            'telephone' => '',
            'rfc' => '',
            'addressphoto' => '1',
            'idphoto' => '1',
            'verified' => '0',
            'innerID' => 'PENDIENTE',
            'numero_cuenta' => '',
            'asesor_id' => $userid,
            'asesor' => $data['asesor'],
        ]);
    }


    public function getUserData($id){
        $beneficiarios = Beneficiarios::where('user_id', '=', $id)->get();
        $inversiones = InversionCliente::where('user_id', '=', $id)->get();
        return view('clienteData',['beneficiarios' => $beneficiarios, 'inversiones' => $inversiones,] );
    }

    public function cambiarContrasena(Request $request)
{
    $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = Auth::user(); // Obtenemos al usuario autenticado

    // Actualizamos la contraseña del usuario
    $user->password = Hash::make($request->password);
    $user->password_change_required = false; // Opcional: Si deseas desactivar la necesidad de cambio de contraseña
    $user->save();

    return redirect()->route('asesor')->with('success', 'Contraseña cambiada con éxito');
}
}
