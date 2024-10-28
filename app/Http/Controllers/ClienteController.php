<?php

namespace App\Http\Controllers;

use App\Models\Beneficiarios;
use App\Models\Contrato_inversion;
use App\Models\DatosUsuario;
use App\Models\Beneficiario_inversion;
use App\Models\Empresa_inversion;
use App\Models\Estado_inversion;
use App\Models\Procedencia;
use App\Http\Requests\AlmacenarBeneficiario;
use App\Models\InversionCliente;
use App\Models\photos;
use App\Mail\MailAltaCliente;
use App\Mail\ProcesoInversionMail;
use App\Mail\reinversion;
use App\Mail\InversionExitosaMail;
use App\Mail\Firmacliente;
use App\Mail\CancelacionMail;
use App\Mail\ReinversionMail;
use App\Mail\CancelacionConfirmadaMail;
use App\Models\User;
use App\Mail\ContactoMail;
use App\Mail\UsuarioCuentaMail;
use App\Models\Proyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Storage;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
Use App\Models\Banco;
use App\Mail\ContratoMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class clienteController extends Controller
{

    public function index()
    {
        // $role = DatosUsuario::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->hasRoles(['admin'])) {
            $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('verified', 0)
                ->paginate(15);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::all();
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            return view('admin', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
        }
        else {
            $userid = Auth::user()->id;
            $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
            $inversionesActivas = InversionCliente::obtener($userid, 1);
            $inversionesPendientes = InversionCliente::obtener($userid, 2);
            $inversionesTerminadas = InversionCliente::obtener($userid, 3);
            $datos = DatosUsuario::where('user_id', $userid)->get();
            return view('controlCliente', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
        }
        return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }



    public function postInversion(Request $request)
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::user()->id;
    
        // Llama a la función uploadImage con el Request y el ID del usuario
        $imagePath = $this->uploadImage($request, $userId);
    
        $inversion = new InversionCliente();
        $inversion->user_id = $userId;
    
        // Remueve los símbolos para hacer la validación
        $cantidadInversionSinFormato = floatval(str_replace([',', '$'], '', $request->input('cantidadInversion')));
    
        $inversion->cantidad = $cantidadInversionSinFormato; // Almacena temporalmente la cantidad sin formato
        $inversion->empresa_inversion_id = (Empresa_inversion::where('activa', true)->first())->id;
    
        // Filtrar reinversiones basadas en el formato del folio
        try {
            $ultimoFolio = InversionCliente::where('empresa_inversion_id', $inversion->empresa_inversion_id)
                ->whereRaw("folio NOT LIKE '%-AD%'")  // Excluye las reinversiones
                ->latest('created_at')->first();

            $inversion->folio = $ultimoFolio ? ($ultimoFolio->folio + 1) : 1;
        } catch (\Throwable $th) {
            $inversion->folio = 1;
        }
        // Genera un pre_folio incrementable, excluyendo valores existentes
        try {
            $ultimoPreFolio = InversionCliente::where('empresa_inversion_id', $inversion->empresa_inversion_id)
                ->latest('pre_folio')->first();  // Asegúrate de ordenar por 'pre_folio'
            
            $inversion->pre_folio = $ultimoPreFolio ? ($ultimoPreFolio->pre_folio + 1) : 1;
        } catch (\Throwable $th) {
            $inversion->pre_folio = 1;
}
    
        $inversion->pre_folio_estado = 'si';
        $inversion->cuenta_pago_rendimientos = $request->input('rendimiento');
        $inversion->cfdi = $request->input('cfdi');
        $inversion->fecha_inicio = Carbon::now();
        $inversion->fecha_termino = InversionCliente::obtenerPlazo($request->input('plazoInversion'));
        
        // Calcular el plazo en años entre la fecha de inicio y la fecha de término
        $plazoInversion = Carbon::parse($inversion->fecha_inicio)->diffInYears(Carbon::parse($inversion->fecha_termino));
        $inversion->estado_inversion_id = 5;
        $inversion->contrato_inversion_id = 5;
    
        // Validaciones para tasa_mensual usando la cantidad sin formato
        if (($plazoInversion == 1 || $plazoInversion == 2 || $plazoInversion == 3 || $plazoInversion == 5) &&
            $cantidadInversionSinFormato >= 50000 && $cantidadInversionSinFormato < 1000000) {
            $inversion->tasa_mensual = 1;
        } elseif (($plazoInversion == 3 || $plazoInversion == 5) && $cantidadInversionSinFormato >= 1000000) {
            $inversion->tasa_mensual = 1.25;
        } else {
            $inversion->tasa_mensual = 1; // Valor predeterminado
        }
    
        // Volver a formatear la cantidad para guardarla con el formato adecuado
        $inversion->cantidad = '$' . number_format($cantidadInversionSinFormato, 2);
    
        // Almacenar el objeto de inversión en la sesión
        Session::put('inversion', $inversion);
        Session::save();
    
        return Redirect::to('registro/altabeneficiario');
    }
    
    
    

    
    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);
    
        // Buscar el usuario por ID
        $user = User::findOrFail($id);
    
        // Generar un nombre de archivo único usando rand() y los datos proporcionados
        $new_nameestado = rand() . $user->name . $user->lastName . 'CFDI.' . $request->image->extension();
    
        // Mover la imagen a la carpeta public/cfdi con el nuevo nombre
        $request->image->move(public_path('cfdi'), $new_nameestado);
    
        // Guardar la ruta de la imagen en la tabla photos
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'cfdi/' . $new_nameestado;
        $photo->save();
    
        return 'cfdi/' . $new_nameestado;
    }


    public function saveImage(Request $request)
    {
        if ($request->hasFile('fiscal')) {
            $file = $request->file('fiscal');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('cfdi');
            
            // Crear el directorio si no existe
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $file->move($path, $filename);
            
            return 'cfdi/' . $filename;
        }
        return null;
    }
    


 

    public function contrato()
    {
        return view('contrato');
    }
    public function Reinversion(Request $request)
    {
        request()->validate([
            'cantidadInversion' => 'required|confirmed',
            'plazoInversion' => 'required',
            'id' => 'required|numeric',
            'cuentaTransferencia' => 'required|confirmed|numeric'
        ]);

        $data = $request->all();
        $inversion = new InversionCliente();
        $inversion->cantidad = $data['cantidadInversion'];
        $inversion->fecha_inicio = Carbon::now();
        $inversion->fecha_termino = InversionCliente::obtenerPlazo($data['plazoInversion']);
        $inversionBase = InversionCliente::where([
            ['id', $data['id']],
            ['user_id', Auth::user()->id],
        ])->first();
        $resultado = app('App\Http\Controllers\pdfController')->contratoReinversion($inversion, $inversionBase);

        if ($inversionBase) {
            if ($inversionBase->cantidad < $inversion->cantidad) {
                $inversion->contrato_inversion_id = 2;
            } elseif ($inversionBase->cantidad > $inversion->cantidad) {
                $inversion->contrato_inversion_id = 3;
            } else {
                $inversion->contrato_inversion_id = 4;
            }

            $inversion->cuenta_pago_rendimientos = $data['cuentaTransferencia'];
            $inversion->estado_inversion_id = 2;
            $inversion->empresa_inversion_id = $inversionBase->empresa_inversion_id;
            $inversion->user_id = Auth::user()->id;

            // Obtén el último folio del cliente, independientemente del sufijo
            $lastFolio = InversionCliente::where('user_id', Auth::user()->id)
                ->orderBy('folio', 'desc')
                ->first();
                if ($lastFolio) {
                    // Verifica si $lastFolio es null antes de acceder a la propiedad folio
                    $lastFolioNumber = intval(substr($lastFolio->folio, -3));
                    $newFolioNumber = str_pad($lastFolioNumber + 1, 3, '0', STR_PAD_LEFT);
                
                    // Reemplaza el último número en el folio existente con el nuevo número
                    $inversion->folio = preg_replace('/-AD\d{3}$/', '-AD' . $newFolioNumber, $lastFolio->folio);
                } else {
                    // Si no hay folios anteriores para el cliente, asigna un folio inicial
                    $inversion->folio = 'AD001'; // O cualquier otro formato que desees
                }

            Session::put('inversion', $inversion);
            Session::save();

            return view('contratoReinversion', compact('inversion'));
        } else {
            // Manejar el caso cuando no se encuentra una inversión base
            return redirect()->back()->withErrors(['No se encontró la inversión base.']);
        }
    }




    public function cambiarClabe(Request $request, $id)
    {
        $datos = User::find($id);
            // Guardar la imagen de estadodecuenta
            $imagefiscal = $request->file('estadodecuenta');
            if ($imagefiscal) {
                $new_nameestado = rand() . $datos['name'] . $datos['lastName'] . 'estado.' . $imagefiscal->getClientOriginalExtension();
                $imagefiscal->move(public_path('estadodecuenta'), $new_nameestado);
                $photo = new photos();
                $photo->user_id = $id;
                $photo->path = 'estadodecuenta/' . $new_nameestado;
                $photo->save();
            }
            $datos->save();
        // Obtener el ID de la inversión y la nueva CLABE de la solicitud
        $id = $request->input('id');
        $password = $request->input('password');
        $nuevaClabe = $request->input('nuevaClabe');
        $confirmarClabe = $request->input('confirmarClabe');

        // Buscar la inversión por ID y verificar si existe
        $inversionCliente = InversionCliente::find($id);
        if (!$inversionCliente) {
            abort(404, 'Inversión no encontrada');
        }

        // Validar la contraseña del usuario
        if (!Hash::check($password, $inversionCliente->user->password)) {
            throw new \Exception("Contraseña incorrecta");
        }

        // Validar que la nueva CLABE y la confirmación coincidan
        if ($nuevaClabe !== $confirmarClabe) {
            throw new \Exception("La nueva CLABE y la confirmación no coinciden");
        }


        // Guardar la nueva CLABE
        $inversionCliente->cuenta_transferencia = $nuevaClabe;
        $inversionCliente->save();


        return redirect()->back()->with('success', 'CLABE interbancaria actualizada con éxito');
    }

    public function actualizarContratoFirmado($token)
{
    try {
        // Desencripta el token para obtener el user_id
        $user_id = Crypt::decrypt($token);

        // Buscar la última inversión del usuario
        $ultimaInversion = InversionCliente::where('user_id', $user_id)
                                           ->latest()
                                           ->first();

        if ($ultimaInversion) {
            // Obtener los datos del usuario
            $user = User::find($user_id);
            $datosUsuario = DatosUsuario::where('user_id', $user_id)->first();

            if ($user && $datosUsuario) {
                // Obtener la fecha y hora actual
                $fechaFirma = now();

                // Generar clave_firma
                $claveFirma = strtoupper(substr($user->name, 0, 2)) .
                              strtoupper(substr($datosUsuario->lastName, 0, 2)) .
                              $ultimaInversion->folio .
                              $fechaFirma->format('ymd');

                // Actualizar los campos contratofirmado, fecha_firma y clave_firma
                $ultimaInversion->update([
                    'contratofirmado' => "si",
                    'fecha_firma' => $fechaFirma,
                    'clave_firma' => $claveFirma,
                ]);

                // Generar el contrato PDF
                $filename = $this->generarContratoPDF($user->id);

                // Obtener la ruta completa del archivo PDF
                $pdfPath = public_path($filename);

                $datosUsuario = DatosUsuario::where('user_id', $user->id)->first();
                $userName = $user->name;
                $lastName = $datosUsuario ? $datosUsuario->lastName : '';
                // Enviar el correo electrónico con el PDF adjunto
                Mail::to($datosUsuario->email)->send(new ContratoMail($user->id, $pdfPath));
                Mail::to('inversiones@finverr.com')->send(new Firmacliente($userName, $lastName));
                Mail::to('auxiliarinversiones@finverr.com')->send(new Firmacliente($userName, $lastName));
                return view('inversionfinal');
            } else {
                return "No se encontraron datos del usuario o datos del usuario asociados con el ID {$user_id}.";
            }
        } else {
            return "No se encontró ninguna inversión para el usuario con ID {$user_id}.";
        }
    } catch (\Exception $e) {
        // Manejar error si el token no es válido
        return redirect()->route('error.page')->with('error', 'Enlace no válido o expirado.');
    }
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
        $viewName = 'contratos.inversionV3';
    
        // Cargar la vista correcta
        $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras', 'textoProcedenciaStr'));
    
        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';
    
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

    public function postContrato(Request $request)
    {
        request()->validate([
            'contrato',
        ]);
    
        $inversion = session()->get('inversion');
    
        if ($inversion) {
            // Actualizar el campo contratofirmado a "si"
            $inversion->contratofirmado = "si";
            $inversion->save();
    
             // Buscar la inversión base
             $inversionBase = InversionCliente::where([
                ['folio', $inversion->folio],
                ['empresa_inversion_id', $inversion->empresa_inversion_id],
                ['estado_inversion_id', 4]
            ])->latest("updated_at")->first();

            if ($inversionBase) {
                // Actualizar el estado de la inversión base
                if ($inversion->contrato_inversion_id == 3) {
                    $inversionBase->contratofirmado = "si";
                    $inversionBase->estado_inversion_id = 7;
                } elseif ($inversion->contrato_inversion_id == 4) {
                    $inversionBase->contratofirmado = "si";
                    $inversionBase->estado_inversion_id = 9;
                }
                $inversionBase->save();

                // Generar el nuevo folio con el formato -AD###
                $baseFolio = $inversionBase->folio;

                // Buscar el último folio que siga el patrón baseFolio-AD###
                $lastFolio = InversionCliente::where('folio', 'LIKE', "$baseFolio-AD%")
                                             ->orderBy('folio', 'desc')
                                             ->first();

                if ($lastFolio) {
                    // Extraer el número autoincremental actual y sumarle 1
                    $lastNumber = (int) substr($lastFolio->folio, -3);
                    $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                } else {
                    // Si no existe, comenzar con 001
                    $newNumber = '001';
                }

                $newFolio = "$baseFolio-AD$newNumber";
                \Log::info("Nuevo folio generado: " . $newFolio); // Para depuración
                $inversion->folio = $newFolio;

                // Establecer fecha de reinversión y generar clave
                $fechaReinversion = Carbon::now();

                // Obtener datos del usuario
                $user = User::find($inversion->user_id);
                $datosUsuario = DatosUsuario::where('user_id', $user->id)->first();

                // Generar clave de reinversión
                $claveReinversion = strtoupper(substr($user->name, 0, 2)) .
                                    strtoupper(substr($datosUsuario->lastName, 0, 2)) .
                                    $inversion->folio .
                                    $fechaReinversion->format('ymd');

                // Cambiar el estado de la inversión base a 3
                $inversionBase->estado_inversion_id = 3;
                $inversionBase->save();

                // Actualizar los datos de la nueva inversión
                $inversion->fecha_reinversion = $fechaReinversion;
                $inversion->estado_inversion_id = 1; // Cambiar a activo
                $inversion->clave_reinversion = $claveReinversion;

                // Guardar la inversión con los nuevos datos
                $inversion->contratofirmado = "si";
                $inversion->save();

                // Generar el PDF de reinversión
                $filename = $this->generarReinversionPDF($user->id);
                $pdfPath = public_path($filename);
                $usuario = Auth::user();

                // Enviar correo de reinversión con el PDF adjunto
                Mail::to($usuario->email)->send(new ReinversionMail($pdfPath));
                
            }
        }
    
        $user = User::find($inversion->user_id);
        return redirect()->route('invcliente', ['id' => $user->id])
        ->with('success', 'La inversión ha sido cancelada correctamente.');
    }
    
    



    public function postContratopre(Request $request)
    {
        request()->validate([
            'contrato',
        ]);
        $inversion = session()->get('inversion');
        $inversion->save();
        if ($inversion->contrato_inversion_id == 3 || $inversion->contrato_inversion_id == 4) {
            $inversionBase = InversionCliente::where([
                ['folio' , $inversion->folio],
                ['empresa_inversion_id' , $inversion->empresa_inversion_id],
                ['estado_inversion_id' , 4]
                ])->latest("updated_at")->first();
            if ($inversion->contrato_inversion_id == 3) {
                $inversionBase->estado_inversion_id = 7;
            } elseif($inversion->contrato_inversion_id ==  4) {
                $inversionBase->estado_inversion_id = 9;
            }
            $inversionBase->save();
        }

        $userid = Auth::user()->id;

    // Obtener la última inversión del usuario
    $ultimaInversion = InversionCliente::where('user_id', $userid)
                                       ->orderBy('created_at', 'desc')
                                       ->first();

    if ($ultimaInversion) {
        return redirect()->route('procedencia', ['id' => $ultimaInversion->id]);
    } else {
        // Manejar el caso donde no hay inversiones
        return redirect()->route('procedencia', ['id' => $userid])->with('message', 'No se encontraron inversiones para este usuario.');
    }
    }

    public function createInversion(array $data)
    {
        $user = User::findOrFail(Auth::user()->id);
        $this->authorize($user);
        return InversionCliente::create([
            'user_id' => Auth::user()->id,
            'folio' => $data['folio'],
            'cantidad' => $data['cantidad'],
            'cuenta_transferencia' => $data['account'],
            'fecha_inicio' => $data['fecha_inicio_contrato'],
            'fecha_termino' => $data['fecha_termino_contrato'],
            'empresa_inversion_id' => $data['empresa_inversion_id'],
            'estado_inversion_id' => $data['estado_inversion_id'],
            'contrato_inversion_id' => $data['contrato_inversion_id'],
            'titular_transferencia' => $data['titular_transferencia'],
        ]);
    }
    public function getBeneficiariosCount()
    {
        // Obtener el recuento de beneficiarios para el usuario actual
        return Beneficiarios::where('user_id', Auth::user()->id)->count();
    }
    public function postBeneficiario(AlmacenarBeneficiario $request)
{
    // Verificar si el usuario ya tiene tres beneficiarios registrados
    if ($this->getBeneficiariosCount() >= 4) {
        return redirect()->back()->withErrors('Ya has registrado el máximo de cuatro beneficiarios.');
    }

    // Si el usuario no ha alcanzado el límite de tres beneficiarios, crear uno nuevo
    $this->createBeneficiario($request->all());

    return Redirect::to("registro/altabeneficiario")->withSuccess('Se ha registrado tu beneficiario exitosamente, selecciona los beneficiarios para tu inversión');
}

public function createBeneficiario(array $data)
{
    $user = User::findOrFail(Auth::user()->id);
    $this->authorize($user);

    // Verificar si se ha seleccionado "Otros" y establecer el valor adecuado para 'relationship'
    $relationship = $data['parentescoBeneficiario'] === 'Otros' ? $data['especificarOtros'] : $data['parentescoBeneficiario'];

    return Beneficiarios::create([
        'user_id' => Auth::user()->id,
        'name' => $data['nombreBeneficiario'],
        'lastName' => $data['apellidoBeneficiario'],
        'relationship' => $relationship,
        'edad' => $data['edadBeneficiario'],
    ]);
}


    public function postComprobante(Request $request)
    {
        request()->validate([
            'id' => 'required|numeric',
            'comprobanteImg' => 'required|mimes:jpeg,png,pdf',
        ]);
        
        $data = $request->all();
        $file = $request->file('comprobanteImg');
        $new_name = rand() . 'Comprobante.' . $file->getClientOriginalExtension();
        $file->move(public_path('comprobante'), $new_name);
        
        $photo = new photos();
        $photo->user_id = Auth::user()->id;
        $photo->path = 'comprobante/' . $new_name;
        $photo->save();
        
        $inversion = InversionCliente::find($data['id']);
        $inversion->estado_inversion_id = 1;
        $inversion->save();
        
        // Obtenemos los datos del usuario
        $usuario = Auth::user();
        $datosUsuario = DatosUsuario::where('user_id', $usuario->id)->first();
        $userName = $usuario->name;
        $lastName = $datosUsuario->lastName;
    
        // Enviamos el correo al usuario
        Mail::to($usuario->email)->send(new InversionExitosaMail($userName, $lastName));
        Mail::to('inversiones@finverr.com')->send(new ProcesoInversionMail($userName, $lastName));
        Mail::to('auxiliarinversiones@finverr.com')->send(new ProcesoInversionMail($userName, $lastName));
    
        return Redirect::to("registro/fininv")->withSuccess('Recibimos tu comprobante, un asesor se contactará contigo.');
    }
    

    public function postAccount(Request $request)
    {
        request()->validate([
            'accountNo' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048',
        ]);
        $image = $request->file('accountNo');
        $new_name = rand() . 'accountNo.' . $image->getClientOriginalExtension();
        $image->move(public_path('accountNo'), $new_name);
        $photo = new photos();
        $photo->user_id = Auth::user()->id;
        $photo->path = 'accountNo/' . $new_name;
        $photo->save();
        $account = DatosUsuario::where('user_id', Auth::user()->id)->first();
        $account->innerID = 'OK';
        $account->save();
        return Redirect::to("registro/lobby")->withSuccess('Recibimos tu número de cuenta, esta en proceso de validación');
    }

    public function update(Request $request, $id) {
    $messages = [
        'idphoto.required' => 'La foto de identificación es obligatoria.',
        'idphoto.mimes' => 'La foto de identificación debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'idphoto.max' => 'La foto de identificación no debe ser mayor de 2MB.',
        'idphotoback.mimes' => 'La parte posterior de la identificación debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'idphotoback.max' => 'La parte posterior de la identificación no debe ser mayor de 2MB.',
        'addressphoto.required' => 'La foto de la dirección es obligatoria.',
        'addressphoto.mimes' => 'La foto de la dirección debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'addressphoto.max' => 'La foto de la dirección no debe ser mayor de 2MB.',
        'estadodecuenta.required' => 'El estado de cuenta es obligatorio.',
        'estadodecuenta.mimes' => 'El estado de cuenta debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'estadodecuenta.max' => 'El estado de cuenta no debe ser mayor de 2MB.',
    ];

    // Validación de los archivos
    $validator = Validator::make($request->all(), [
        'idphoto' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        'idphotoback' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        'addressphoto' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        'estadodecuenta' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
    ], $messages);

    // Si la validación falla, redirigir con errores
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Obtener el usuario
    $datos = User::find($id);

    // Asignar los campos restantes desde la solicitud HTTP
    $datos->identificacion = $request->input('identificacion');
    $datos->numero = $request->input('numero');

    // Procesar la imagen o PDF de idphoto
    if ($request->hasFile('idphoto')) {
        $file = $request->file('idphoto');
        $new_name = rand() . $datos->name . $datos->lastName . 'Id.' . $file->getClientOriginalExtension();
        $file->move(public_path('ids'), $new_name);
        $photo = new Photos();
        $photo->user_id = $id;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
    }

    // Procesar la imagen o PDF de idphotoback
    if ($request->hasFile('idphotoback')) {
        $fileidback = $request->file('idphotoback');
        $new_name = rand() . $datos->name . $datos->lastName . 'IdBack.' . $fileidback->getClientOriginalExtension();
        $fileidback->move(public_path('ids'), $new_name);
        $photo = new Photos();
        $photo->user_id = $id;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
    }

    // Procesar la imagen o PDF de addressphoto
    if ($request->hasFile('addressphoto')) {
        $fileaddress = $request->file('addressphoto');
        $new_nameaddress = rand() . $datos->name . $datos->lastName . 'address.' . $fileaddress->getClientOriginalExtension();
        $fileaddress->move(public_path('addressPhotos'), $new_nameaddress);
        $photo = new Photos();
        $photo->user_id = $id;
        $photo->path = 'addressPhotos/' . $new_nameaddress;
        $photo->save();
    }

    // Procesar la imagen o PDF de estadodecuenta
    if ($request->hasFile('estadodecuenta')) {
        $fileestado = $request->file('estadodecuenta');
        $new_nameestado = rand() . $datos->name . $datos->lastName . 'estado.' . $fileestado->getClientOriginalExtension();
        $fileestado->move(public_path('estadodecuenta'), $new_nameestado);
        $photo = new Photos();
        $photo->user_id = $id;
        $photo->path = 'estadodecuenta/' . $new_nameestado;
        $photo->save();
    }



    // Guardar los cambios en la base de datos
    $datos->save();

    // Redirigir a la URL especificada
    return redirect()->to("registro/contratopre");
} 
    


    public function eliminarFoto($id) {
        $photo = photos::findOrFail($id);
        $path = public_path($photo->path);
        if (file_exists($path)) {
            unlink($path);
        }
        $photo->delete();

        return redirect()->back()->with('success', 'La foto ha sido eliminada correctamente');
    }
    public function updatedocumentos(Request $request, $id){


        $datos = User::find($id);

        $datos->identificacion = $request->input('identificacion');
    $datos->numero = $request->input('numero');

    // Asignar los campos restantes desde la solicitud HTTP


        // Guardar la imagen de idphoto
    $image = $request->file('idphoto');
    if ($image !== null) {
        $new_name = rand() . $datos['name'] . $datos['lastName'] . 'Id.' . $image->getClientOriginalExtension();
        $image->move(public_path('ids'), $new_name);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
    }

    $imageidback = $request->file('idphotoback');
    if ($imageidback !== null) {
        $new_name = rand() . $datos['name'] . $datos['lastName'] . 'IdBack.' . $imageidback->getClientOriginalExtension();
        $imageidback->move(public_path('ids'), $new_name);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
    }

    // Guardar la imagen de addressphoto
    $imageaddress = $request->file('addressphoto');
    if ($imageaddress !== null) {
        $new_nameaddress = rand() . $datos['name'] . $datos['lastName'] . 'address.' . $imageaddress->getClientOriginalExtension();
        $imageaddress->move(public_path('addressPhotos'), $new_nameaddress);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'addressPhotos/' . $new_nameaddress;
        $photo->save();
    }

    // Guardar la imagen de fiscalphoto
    $imagefiscal = $request->file('fiscalphoto');
    if ($imagefiscal !== null) {
        $new_namefiscal = rand() . $datos['name'] . $datos['lastName'] . 'fiscal.' . $imagefiscal->getClientOriginalExtension();
        $imagefiscal->move(public_path('fiscalphoto'), $new_namefiscal);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'fiscalphoto/' . $new_namefiscal;
        $photo->save();
    }

    // Guardar la imagen de estadodecuenta
    $imageestado = $request->file('estadodecuenta');
    if ($imageestado !== null) {
        $new_nameestado = rand() . $datos['name'] . $datos['lastName'] . 'estado.' . $imageestado->getClientOriginalExtension();
        $imageestado->move(public_path('estadodecuenta'), $new_nameestado);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'estadodecuenta/' . $new_nameestado;
        $photo->save();
    }

        // Guardar los cambios en la base de datos
        $datos->save();
        return redirect()->route('datoscliente')->with("success");

    }

    public function patchInversion($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $this->authorize($user);
        $inversion = InversionCliente::where([
            ['id', $id],
            ['user_id', $user->id],
        ])->first();
        $inversion->estado_inversion_id = 8;
        $inversion->save();
        
        // Obtener el apellido del usuario desde la tabla datos_usuario
        $usuario = Auth::user();
        $datosUsuario = DatosUsuario::where('user_id', $usuario->id)->first();
        $userName = $usuario->name;
        $lastName = $datosUsuario->lastName;
        
        // Enviar un correo al usuario de la cuenta
        Mail::to('programacion@finverr.com')->send(new UsuarioCuentaMail());

        // Enviar un correo al administrador
        Mail::to('programacion@finverr.com')->send(new reinversion($userName, $lastName));


        return Redirect::to("registro/lobby")->withSuccess('Estimado CLIENTE obtendrá la devolución íntegra de la cantidad entregada en mutuo, a más tardar en los treinta días hábiles posteriores a la expiración del contrato vía transferencia electrónica.');
    }
    public function reinversionVista($id)
    {
        $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('user_id', $userid)
                ->paginate(15);
        $inversion = InversionCliente::find($id);
        $proyecto = proyecto::all();
        return view('reinversion', ['inversion' => $inversion, 'proyecto' => $proyecto, 'usuarios' => $users]);
    }



    public function perfil( $id )
    {

        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->where('user_id', $id)
                ->paginate(50);
            return view('datoscliente')->with('usuarios',$users);
            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }



    public function indexdatos(  )
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
            return view('datoscliente')->with('usuarios',$users);
    }
    public function indexdatosinicio(  )
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
            return view('actualizar')->with('usuarios',$users);
    }
    public function indexdatosinicioase(  )
    {
        $userid = Auth::user()->id;
        $users = User::all()->where('id', $userid);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::all();
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            return view('actualizarasesor')->with('usuarios',$users);
    }
    public function documentos(  )
    {
        $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('user_id', $userid)
                ->paginate(15);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::where('user_id', $userid)->paginate(1);
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            $userid = Auth::user()->id;
            return view('documentos')->with('usuarios',$users, 'inversiones', $inversiones);
    }
    public function precontrato(  )
    {
        $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where('user_id', $userid)
                ->paginate(15);
            $beneficiarios = Beneficiarios::all();
            $inversiones = InversionCliente::where('user_id', $userid)->paginate(1);
            $empresas = Empresa_inversion::all();
            $contratos = Contrato_inversion::all();
            $estados = Estado_inversion::all();
            $userid = Auth::user()->id;
            return view('contratopre')->with('usuarios',$users, 'inversiones', $inversiones);
    }

    public function indexdatoinv(  )
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
            return view('altabeneficiario')->with('usuarios',$users);
    }

    public function activa(Request $request, $id){
        $estatus = DatosUsuario::find($id);
        $estatus->estado_fotos = '3';
        $estatus->save();
        return redirect()->route('informacioncliente')->with("success","Validacion Actualizada");
    }

     public function resetpassword(Request $request ,User $users){
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password-confirm' => 'required|confirmed|min:8',
        ]);
        $users->update([
            'email' => $request->email,
            'password' => $request->password,
            'password-confirm' => $request->remember_token,

        ]);
        return redirect()->route('resetpassword', with($users->user_id))->with('success', 'Se actualizo ');
    }


    public function indexinversion($id )
    {
        $inversiones = InversionCliente::where('user_id', $id)->get();
        return view('invcliente', ['inversiones' => $inversiones]);
    }




    public function indexdatoss()
    {
    $userid = Auth::user()->id;
    $beneficiarios = Beneficiarios::where('user_id', $userid)->orderBy('created_at', 'desc')->paginate(5);
    $inversiones = InversionCliente::where('user_id', $userid)->paginate(1);
    return view('altabeneficiario')->with([ 'beneficiarios' => $beneficiarios, 'inversiones' => $inversiones]);

    }



    public function getBeneficiario( )
    {
        $userid = Auth::user()->id;
        $beneficiarios = Beneficiario_inversion::where('id_user', $userid)->get();
        $inversionesActivas = InversionCliente::obtener($userid, 1);
        $inversionesPendientes = InversionCliente::obtener($userid, 2);
        $inversionesTerminadas = InversionCliente::obtener($userid, 3);
        $datos = DatosUsuario::where('user_id', $userid)->get();
        return view('benfcliente', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
    }



    public function getInversiones( )
    {
        $userid = Auth::user()->id;
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->where('user_id', $userid)
        ->paginate(15);
        $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
        $inversionesActivas = InversionCliente::obtener($userid, 1);
        $inversionesPendientes = InversionCliente::obtener($userid, 2);
        $inversionesTerminadas = InversionCliente::obtener($userid, 3);
        $datos = DatosUsuario::where('user_id', $userid)->get();
        return view('invcliente', ['usuarios',$users,'beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
    }
        public function getInversionescliente( )
    {
        $userid = Auth::user()->id;
        $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
        $inversionesActivas = InversionCliente::obtener($userid, 1);
        $inversionesPendientes = InversionCliente::obtener($userid, 2);
        $inversionesTerminadas = InversionCliente::obtener($userid, 3);
        $datos = DatosUsuario::where('user_id', $userid)->get();
        return view('comprobanteinv', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
    }
    public function getInversioness( )
    {
        $userid = Auth::user()->id;
        $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
        $inversionesActivas = InversionCliente::obtener($userid, 1);
        $inversionesPendientes = InversionCliente::obtener($userid, 2);
        $inversionesTerminadas = InversionCliente::obtener($userid, 3);
        $datos = DatosUsuario::where('user_id', $userid)->get();
        return view('altacomprobante', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
    }

        public function postRegistrationCliente(Request $request)
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

        // Redirigir a la página de administración de clientes con un mensaje de éxito
        return Redirect::to("registro/clienteadmin")->withSuccess('Se ha creado el cliente exitosamente');
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

    public function createUserData(array $data, int $lastId)
    {


        return DatosUsuario::create([
            'user_id' => $lastId,
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'address' => '',
            'postalcode' => '',
            'telephone' => '',
            'rfc' => '',
            'addressphoto' => '1',
            'idphoto' => '1',
            'verified' => '0',
            'innerID' => 'PENDIENTE',
            'numero_cuenta' => '',
            'clave_asesor' => '',
        ]);
    }


    public function menu(  )
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
    }

    public function menuasesor()
    {
        $userid = Auth::user()->id;
        $users = User::all()->where('id', $userid);
            return view('/views/inc/navphotos')->with('usuarios',$users);
            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }

    public function save_data(Request $request)
    {
        $userid = Auth::user()->id;
    
        // Verificar si el cliente tiene inversiones existentes
        $inversionesCliente = InversionCliente::where('user_id', $userid)->get();
    
        if ($inversionesCliente->count() > 0) {
            // Obtener la última inversión del cliente
            $inversion = $inversionesCliente->first();
            $inversionId = $inversion ? $inversion->id : null;
        } else {
            // Si no tiene inversiones, no se asigna un ID de inversión
            $inversionId = null;
        }
        $inversion = Session::get('inversion');
        $preFolio = $inversion->pre_folio;
        $porcentajes = $request->input('porcentaje'); // Esto ahora contiene los IDs como claves

        // Recuperar los beneficiarios para validar el orden
        $beneficiarios = Beneficiarios::where('user_id', $userid)->pluck('id')->toArray();// Obtener los porcentajes enviados en la solicitud
    
        // Recorrer los porcentajes y guardar los datos solo si están llenados
        foreach ($beneficiarios as $beneficiarioID) {
            if (isset($porcentajes[$beneficiarioID]) && !empty($porcentajes[$beneficiarioID])) {
                $beneficiarioInversion = new Beneficiario_inversion();
                $beneficiarioInversion->porcentaje = $porcentajes[$beneficiarioID];
                $beneficiarioInversion->id_user = $userid;
                $beneficiarioInversion->id_inversion = $preFolio; // Asignar pre_folio al id_inversion
                $beneficiarioInversion->id_beneficiario = $beneficiarioID;

                // Obtener datos adicionales del beneficiario
                $beneficiario = Beneficiarios::find($beneficiarioID);
                if ($beneficiario) {
                    $beneficiarioInversion->relationship = $beneficiario->relationship;
                    $beneficiarioInversion->edad = $beneficiario->edad;
                    $beneficiarioInversion->name = $beneficiario->name . ' ' . $beneficiario->lastName;
                }

                $beneficiarioInversion->save();
            }
        }
    
        // Redirigir según si el cliente tiene inversiones o no
        if ($inversionId) {
            return Redirect::to("registro/contratopre"); // Redirigir si hay inversión existente
        } else {
            return redirect()->route('documentos') // Redirigir si no hay inversiones
                ->with('mensaje', 'Recuerda subir tus documentos de manera clara y legible. Asegúrate de que el comprobante de domicilio no tenga más de tres meses de antigüedad y que el estado de cuenta para pago de rendimientos incluya la CLABE interbancaria.');
        }
    }
    
    




    public function updateDatos(Request $request ,$id){
        $cliente=DatosUsuario::findOrFail($id);
        $cliente->cuenta_transferencia	=$request->input('account');
        $cliente->address=$request->input('address');
        $cliente->numero_ext=$request->input('numero_ext');
        $cliente->num_int=$request->input('numero_int');
        $cliente->colonia=$request->input('colonia');
        $cliente->postalcode=$request->input('postalcode');
        $cliente->municipio=$request->input('municipio');
        $cliente->ciudad=$request->input('ciudad');
        $cliente->telephone=$request->input('telephone');
        $cliente->save();
        return redirect()->route('datoscliente')->with("success","Validacion Actualizada");
    }
    public function updateDatosinicio(Request $request, $id)
    {
        $cliente = DatosUsuario::findOrFail($id);
        $cliente->rfc = $request->input('rfc');
        $cliente->birthday = $request->input('birthday');
        $cliente->cuenta_transferencia = $request->input('account');
        $cliente->address = $request->input('address');
        $cliente->numero_ext = $request->input('numero_ext');
        $cliente->num_int = $request->input('numero_int');
        $cliente->colonia = $request->input('colonia');
        $cliente->postalcode = $request->input('postalcode');
        $cliente->municipio = $request->input('municipio');
        $cliente->ciudad = $request->input('ciudad');
        $cliente->telephone = $request->input('telephone');

        $cliente->save();

        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('password')) {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Actualizar la contraseña del usuario
            $user->password = bcrypt($request->input('password'));
            // Marcar la contraseña como requerida para el cambio
            $user->password_change_required = true;

            $user->save();
        }

        return redirect()->route('lobby')->with("success", "Validación Actualizada");
    }
    public function updateDatosinicioase(Request $request, $id)
    {
        // Verificar si se proporcionó una nueva contraseña
        if ($request->filled('password')) {
            // Obtener el usuario autenticado
            $user = User::find($id);

            // Actualizar la contraseña del usuario
            $user->password = bcrypt($request->input('password'));
            // Marcar la contraseña como requerida para el cambio
            $user->password_change_required = false;

            $user->save();
        }

        return redirect()->route('asesor')->with("success", "Validación Actualizada");
    }




    public function getGallery($id)
    {
        $fotos = photos::where('user_id', $id)->get();

        return view('gallery', ['fotos' => $fotos]);
    }


    public function postProcedencia(Request $request)
{
    $messages = [
        'comprobantes.*.mimes' => 'Cada comprobante debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'comprobantes.*.max' => 'Cada comprobante no debe ser mayor de 2MB.',
        'estado_cuenta.*.mimes' => 'Cada archivo de estado de cuenta debe ser un archivo de tipo: jpeg, png, jpg, gif, svg, pdf.',
        'estado_cuenta.*.max' => 'Cada archivo de estado de cuenta no debe ser mayor de 2MB.',
        'comprobantes.max' => 'Solo se pueden subir hasta 3 comprobantes de transferencia.',
        'estado_cuenta.max' => 'Solo se pueden subir hasta 3 archivos de estado de cuenta.',
    ];

    $validator = Validator::make($request->all(), [
        'comprobantes.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        'comprobantes' => 'array|max:3', // Max 3 files
        'estado_cuenta.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        'estado_cuenta' => 'array|max:3', // Max 3 files
    ], $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $id = $request->input('id');
    $user = Auth::user(); // Obtén el usuario autenticado

    // Procesar archivos de comprobantes de transferencia
    if ($request->hasFile('comprobantes')) {
        foreach ($request->file('comprobantes') as $key => $file) {
            if ($file->isValid()) {
                $photo = Photos::create(['user_id' => $user->id, 'path' => 'comprobante/' . uniqid() . '.' . $file->getClientOriginalExtension()]);

                $file->move(public_path('comprobante'), $photo->path);

                // Actualiza el registro con el nuevo nombre
                $photo->path =  $photo->path;
                $photo->save();
            }
        }
    }

    // Procesar archivos de estado de cuenta
    if ($request->hasFile('estado_cuenta')) {
        foreach ($request->file('estado_cuenta') as $key => $file) {
            if ($file->isValid()) {
                $photo = Photos::create(['user_id' => $user->id, 'path' => 'estadodecuenta/' . uniqid() . '.' . $file->getClientOriginalExtension()]);

                $file->move(public_path('estadodecuenta'), $photo->path);

                // Actualiza el registro con el nuevo nombre
                $photo->path =  $photo->path;
                $photo->save();
            }
        }
    }

    // Actualizar el estado de la inversión
    $inversion = InversionCliente::find($id);
    if ($inversion) {
        $inversion->estado_inversion_id = 1; // Cambia el estado según sea necesario
        $inversion->save();
    }

    // Enviar correo al usuario
    $datosUsuario = DatosUsuario::where('user_id', $user->id)->first();
    $userName = $user->name;
    $lastName = $datosUsuario ? $datosUsuario->lastName : '';

    Mail::to($user->email)->send(new InversionExitosaMail($userName, $lastName));
    Mail::to('inversiones@finverr.com')->send(new ProcesoInversionMail($userName, $lastName));
    Mail::to('auxiliarinversiones@finverr.com')->send(new ProcesoInversionMail($userName, $lastName));

    return redirect()->back()->with('success', '
    <h1>¡Felicidades!</h1>
    <p>¡Nos complace informarte que tu proceso de pre-inversión se ha completado exitosamente! Validaremos tu información, y en las próximas 72 horas recibirás un pre-contrato en tu correo electrónico registrado. Así podrás revisar tus datos y proceder con la firma electrónica.</p>
    <p>Si tienes alguna pregunta o necesitas ayuda adicional, no dudes en contactarnos. ¡Estamos aquí para apoyarte en cada paso del camino!</p>
');
}

    
    
    
    




    public function mostrarFormulario()
    {
        // Obtener los datos del usuario actual y otras relaciones necesarias
        $user = User::find(auth()->user()->id);
        $datosUsuario = DatosUsuario::where('user_id', auth()->user()->id)->first();
        $inversionCliente = session()->get('inversion');
        $beneficiariosInversion = Beneficiario_inversion::where('id_user', auth()->user()->id)->get();

        // Verificar si los modelos están cargados correctamente
        if (!$user || !$datosUsuario || !$inversionCliente || $beneficiariosInversion->isEmpty()) {
            abort(404); // Manejar el caso donde no se encuentran datos del usuario
        }

        return view('contratopre', compact('user', 'datosUsuario', 'inversionCliente', 'beneficiariosInversion'));
    }




    public function actualizar(Request $request)
    {
        $request->validate([
            // Campos de User
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            // Campos de DatosUsuario
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'numero_ext' => 'required|string|max:10',
            'num_int' => 'nullable|string|max:10', // num_int puede quedar vacío
            'codigo_postal' => 'required|string|max:10',
            'telefono' => 'required|string|max:20',
            'rfc' => 'required|string|max:20',
            // Campos de InversionCliente
            'cantidad' => 'required',
            'cuenta_pago_rendimientos' => 'nullable|string|max:255',
            // Campos de Beneficiario_inversion
            'plazoInversion' => 'required',
            'porcentaje' => 'required|array',
            'relacion' => 'required|array',
            'nombre_beneficiario' => 'required|array',
            'edad_beneficiario' => 'required|array',
        ]);
    
        // Actualización de datos del usuario (tabla User)
        $user = User::find(auth()->user()->id);
        $user->name = $request->nombre;
        $user->identificacion = $request->identificacion;
        $user->numero = $request->numero;
        $user->save();
    

        // Actualización de DatosUsuario
        $datosUsuario = DatosUsuario::where('user_id', auth()->user()->id)->first();
        $datosUsuario->lastName = $request->apellido;
        $datosUsuario->address = $request->direccion;
        $datosUsuario->numero_ext = $request->numero_ext;
        $datosUsuario->num_int = $request->num_int; // Puede quedar vacío
        $datosUsuario->postalcode = $request->codigo_postal;
        $datosUsuario->telephone = $request->telefono;
        $datosUsuario->rfc = $request->rfc;
        $datosUsuario->save();
    
        // Actualización de InversionCliente
        $inversionCliente = session()->get('inversion');
        
        // Remover símbolos para convertir la cantidad a float
        $cantidadInversionSinFormato = floatval(str_replace([',', '$'], '', $request->input('cantidad')));
    
        $inversionCliente->cantidad = $request->cantidad;
        $inversionCliente->cuenta_pago_rendimientos = $request->cuenta_pago_rendimientos;
        $inversionCliente->fecha_inicio = Carbon::now();
        $inversionCliente->fecha_termino = InversionCliente::obtenerPlazo($request->input('plazoInversion'));
    
        // Calcular el plazo de la inversión en años
        $plazoInversion = Carbon::parse($inversionCliente->fecha_inicio)
            ->diffInYears(Carbon::parse($inversionCliente->fecha_termino));
    
        // Validaciones para tasa_mensual usando la cantidad sin formato
        if (($plazoInversion == 1 || $plazoInversion == 2 || $plazoInversion == 3 || $plazoInversion == 5) &&
            $cantidadInversionSinFormato >= 50000 && $cantidadInversionSinFormato < 1000000) {
            $inversionCliente->tasa_mensual = 1;
        } elseif (($plazoInversion == 3 || $plazoInversion == 5) && $cantidadInversionSinFormato >= 1000000) {
            $inversionCliente->tasa_mensual = 1.25;
        } else {
            $inversionCliente->tasa_mensual = 1; // Valor predeterminado
        }
    
        $inversionCliente->save();
    
        // Actualización de Beneficiario_inversion
        $beneficiariosInversion = Beneficiario_inversion::where('id_user', auth()->user()->id)->get();
        
        foreach ($beneficiariosInversion as $index => $beneficiarioInversion) {
            $beneficiarioInversion->porcentaje = $request->porcentaje[$index];
            $beneficiarioInversion->relationship = $request->relacion[$index];
            $beneficiarioInversion->name = $request->nombre_beneficiario[$index];
            $beneficiarioInversion->edad = $request->edad_beneficiario[$index];
            $beneficiarioInversion->save();
        }
    
        return redirect()->back()->with('success', 'Información actualizada correctamente');
    }
    

    public function procedencia(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'id' => 'required|integer', // Validación del ID de la inversión
            'campo1_cantidad' => 'nullable|string',
            'campo1_cuentaclabe' => 'nullable|string',
            'campo1_institucion' => 'nullable|string',
            'campo2_cantidad' => 'nullable|string',
            'campo2_cuentaclabe' => 'nullable|string',
            'campo2_institucion' => 'nullable|string',
            'campo3_cantidad' => 'nullable|string',
            'campo3_cuentaclabe' => 'nullable|string',
            'campo3_institucion' => 'nullable|string',
            'deposito_bancario' => 'nullable|string',
        ]);
    
        $userid = Auth::user()->id;
    
        // Obtén la inversión del cliente usando el ID proporcionado
        $inversionId = $request->input('id');
        $inversion = InversionCliente::find($inversionId);
    
        if (!$inversion) {
            return redirect()->back()->withErrors(['error' => 'Inversión no encontrada.']);
        }
    
        $totalSecciones = 3;
    
        // Guarda los datos en la base de datos
        for ($i = 1; $i <= $totalSecciones; $i++) {
            if (
                $request->filled("campo{$i}_cantidad") &&
                $request->filled("campo{$i}_cuentaclabe") &&
                $request->filled("campo{$i}_institucion")
            ) {
                Procedencia::create([
                    'id_user' => $userid,
                    'id_inversion' => $inversion->id,
                    'cantidad' => $request->input("campo{$i}_cantidad"),
                    'cuentaclabe' => $request->input("campo{$i}_cuentaclabe"),
                    'intitucion' => $request->input("campo{$i}_institucion"),
                    'aprobado' => 0,
                ]);
            }
        }
    
        if ($request->filled("deposito_bancario")) {
            Procedencia::create([
                'id_user' => $userid,
                'id_inversion' => $inversion->id,
                'cantidad' => $request->input("deposito_bancario"),
                'cuentaclabe' => null,
                'intitucion' => 'Depósito Bancario',
                'aprobado' => 0,
            ]);
        }
    
        return redirect()->route('comprobanteinv', ['id' => $userid]);
    }

 
    public function indexprocedencia($id)
    {
        $userid = Auth::user()->id;
        $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
        $inversionesActivas = InversionCliente::obtener($userid, 1);
        $inversion = InversionCliente::findOrFail($id);
    
        $datos = DatosUsuario::where('user_id', $userid)->get();
        return view('procedencia', [
            'beneficiarios' => $beneficiarios, 
            'inversionesActivas' => $inversionesActivas,
            'id' => $userid,
            'inversion' => $inversion
        ]);
    }

    public function mostrarFormularioValidacion($token)
{
    try {
        // Desencripta el token para obtener el user_id
        $user_id = Crypt::decrypt($token);
        return view('firma', ['user_id' => $user_id]);
    } catch (\Exception $e) {
        // Manejar error si el token no es válido
        return redirect()->route('error.page')->with('error', 'Enlace no válido o expirado.');
    }
}
public function validarInformacionFirma(Request $request, $user_id)
{
    $attempts = session('login_attempts', 0);

    if ($attempts >= 3) {
        return redirect()->back()->withErrors(['message' => 'Has alcanzado el número máximo de intentos.']);
    }

    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $user = User::find($user_id);

    if ($user && $user->email === $request->input('email') && Hash::check($request->input('password'), $user->password)) {
        Session::forget('login_attempts'); // Reinicia los intentos al iniciar sesión con éxito

        // Encripta el user_id antes de redirigir
        $token = Crypt::encrypt($user_id);

        // Redirige usando el token en lugar del user_id
        return redirect()->route('actualizar.contrato', ['token' => $token]);
    } else {
        Session::put('login_attempts', $attempts + 1);
        return redirect()->back()->withErrors(['message' => 'Correo o contraseña incorrectos.']);
    }
    }

    public function correocancelar(Request $request)
    {
        $userEmail = $request->user()->email; // Obtener el correo del usuario
        $inversion = InversionCliente::where('user_id', $request->user()->id)->first(); // Obtener la inversión
    
        // Enviar el correo de cancelación con la inversión
        Mail::to($userEmail)->send(new CancelacionMail($inversion));
    
        return redirect()->back()->with('success', 'El correo de cancelación ha sido enviado.');
    }
    

    public function validarCancelacion(Request $request)
    {
        $attempts = session('cancel_attempts', 0);
    
        // Limita a 3 intentos de validación
        if ($attempts >= 3) {
            return redirect()->back()->with('error', 'Has alcanzado el número máximo de intentos.');
        }
    
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        $user = User::where('email', $request->input('email'))->first();
    
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Session::forget('cancel_attempts');
            
            $inversion = InversionCliente::where('user_id', $user->id)->latest()->first();
            if ($inversion) {
                // Establecer el estado de cancelación
                $inversion->estado_inversion_id = '10';
    
                // Establecer la fecha de cancelación como la fecha actual
                $fechaCancelacion = Carbon::now();
                $inversion->fecha_cancelacion = $fechaCancelacion;
    
                // Obtener los datos del usuario para generar la clave de firma
                $datosUsuario = DatosUsuario::where('user_id', $user->id)->first();
                $ultimaInversion = InversionCliente::where('user_id', $user->id)->latest()->first();
                $claveFirma = strtoupper(substr($user->name, 0, 2)) .
                              strtoupper(substr($datosUsuario->lastName, 0, 2)) .
                              $ultimaInversion->folio .
                              $fechaCancelacion->format('ymd');
                              
                // Guardar la clave de firma en la inversión
                $inversion->clave_cancelacion = $claveFirma;
    
                $inversion->save();
    
                // Generar el convenio de cancelación en PDF
                $filename = $this->generarConvenioPDF($user->id);
                $pdfPath = public_path($filename);
    
                // Enviar correo con el PDF adjunto
                Mail::to($user->email)->send(new CancelacionConfirmadaMail($pdfPath));
    
                return redirect()->route('invcliente', ['id' => $user->id])
                                 ->with('success', 'La inversión ha sido cancelada correctamente.');
            }
    
            return redirect()->back()->with('error', 'No se encontró la inversión.');
        } else {
            Session::put('cancel_attempts', $attempts + 1);
            return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
        }
    }
    

        public function generarConvenioPDF($userid)
    {
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
               $viewName = 'contratos.cancelacion';
           
               // Cargar la vista correcta
               $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras', 'textoProcedenciaStr'));
           
               // Generar el nombre del archivo
               $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
               $folioContrato = $inversion->folio;
               $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';
           
               // Guardar el PDF en el directorio public/contratos
               $pdf->save(public_path('contratos/' . $filename));
           
               // Devolver la ruta relativa del archivo
               return 'contratos/' . $filename;
    }



    protected function generarReinversionPDF($userId)
    {
        // Obtener proyectos e inversión de la sesión
        $proyecto = Proyecto::all();
        $inversion = session()->get('inversion');
        $userid = Auth::id();
    
        // Verificar si la inversión está en la sesión, si no, obtenerla de la base de datos
        if (!$inversion) {
            $inversion = InversionCliente::where('user_id', $userid)
                ->orderBy('created_at', 'desc')
                ->first();
        }
    
        // Obtener información de la inversión base
        $folioPrincipal = substr($inversion->folio, 0, strpos($inversion->folio, '-'));
        $inversionBase = InversionCliente::where('folio', $folioPrincipal)->first();
        $empresa = Empresa_inversion::find($inversion->empresa_inversion_id);
        $user = User::where('users.id', Auth::id())
                ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->first();
    
        // Obtener beneficiarios
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
    
        // Obtener la inversión anterior
        $penultimaInversion = InversionCliente::where('user_id', $userid)
            ->orderBy('created_at', 'desc')
            ->skip(1) // Skips the most recent reinvestment
            ->first();
    
        // Eliminar caracteres de moneda
        $cantidadInversionPrincipal = str_replace(['$', ','], '', $penultimaInversion->cantidad);
        $cantidadReinversion = str_replace(['$', ','], '', $inversion->cantidad);
    
        // Formatear las diferencias
        $diferenciaFormateada = number_format(floatval($cantidadInversionPrincipal) - floatval($cantidadReinversion), 2, '.', ',');
        $diferenciamayorFormateada = number_format(floatval($cantidadReinversion) - floatval($cantidadInversionPrincipal), 2, '.', ',');
     // Validaciones basadas en la cantidad de la penúltima inversión y la inversión actual
     if ($cantidadInversionPrincipal < 1000000) {
        if ($cantidadReinversion < 1000000) {
            $mensajeIntereses = 'no representa una actualización en la tasa de intereses ordinarios';
        }
    } elseif ($cantidadInversionPrincipal >= 1000000) {
        if ($cantidadReinversion < 1000000) {
            $mensajeIntereses = 'representa una actualización del pago de intereses moratorios del 1.25% al 1%';
        } else {
            $mensajeIntereses = 'no representa una actualización en la tasa de intereses ordinarios';
        }
    }

        // Validaciones basadas en la cantidad de la penúltima inversión y la inversión actual
        if ($cantidadInversionPrincipal > 1000000) {
            if ($cantidadReinversion > 1000000) {
                $mensajeInteresesmayor = 'no representa una actualización en la tasa de intereses ordinarios';
            }
        } elseif ($cantidadInversionPrincipal <= 1000000) {
            if ($cantidadReinversion > 1000000) {
                $mensajeInteresesmayor = 'representa una actualización del pago de intereses moratorios del 1% al 1.25%';
            } else {
                $mensajeInteresesmayor = 'no representa una actualización en la tasa de intereses ordinarios';
            }
        }
        // Comparar las inversiones y generar el PDF correcto
        if ($cantidadReinversion > $cantidadInversionPrincipal) {
            // Inversión mayor, generar adendummayor
            $pdf = PDF::loadView('contratos.adendummayor', compact(
                'inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 
                'diferenciamayorFormateada','penultimaInversion','mensajeInteresesmayor'
            ));
        } elseif ($cantidadReinversion < $cantidadInversionPrincipal) {
            // Inversión menor, generar adendummenor
            $pdf = PDF::loadView('contratos.adendummenor', compact(
                'inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 
                'diferenciaFormateada','penultimaInversion','mensajeIntereses'
            ));
        } else {
            // Inversiones iguales, generar adendumV1
            $pdf = PDF::loadView('contratos.adendumV1', compact(
                'inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios','penultimaInversion'
            ));
        }
    
        // Generar nombre del archivo
        $nombreCliente = Str::lower($user->name);
        $folioContrato = $inversion->folio;
        $filename = 'contrato_' . $nombreCliente . '_' . $folioContrato . '.pdf';
    
        // Guardar el PDF
        $pdf->save(public_path('contratos/' . $filename));
    
        return 'contratos/' . $filename; // Retorna la ruta del archivo para usarlo en el correo
    }
    

public function validarContrasena(Request $request)
{
    // Obtener el usuario autenticado
    $user = Auth::user();
    
    // Verificar si la contraseña ingresada coincide con la contraseña almacenada
    if (Hash::check($request->password, $user->password)) {
        // Contraseña válida
        return response()->json(['isValid' => true]);
    } else {
        // Contraseña inválida
        return response()->json(['isValid' => false]);
    }
}

public function cancelarConfirmada()
{
    $userid = Auth::user()->id;
    $beneficiarios = Beneficiarios::where('user_id', $userid)->get();
    $inversionesActivas = InversionCliente::obtener($userid, 1);
    $inversionesPendientes = InversionCliente::obtener($userid, 2);
    $inversionesTerminadas = InversionCliente::obtener($userid, 3);
    $datos = DatosUsuario::where('user_id', $userid)->get();
    return view('mailcancelacion', ['beneficiarios' => $beneficiarios, 'inversionesActivas' => $inversionesActivas, 'inversionesPendientes' => $inversionesPendientes, 'inversionesTerminadas' => $inversionesTerminadas, 'datos' => $datos]);
}


}