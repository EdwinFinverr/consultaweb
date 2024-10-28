<?php

namespace App\Http\Controllers;

use App\Models\Empresa_inversion;
use App\Models\InversionCliente;
use App\Models\User;
use App\Models\Beneficiarios;
Use App\Models\Proyecto;
Use App\Models\Banco;
Use App\Models\Procedencia;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use Money\Currency;


class pdfController extends Controller
{
    public function crearData($años, $empresa, $user, $cantidad, $dt, $day, $tipo_contrato,$proyecto,$beneficiarios)
    {
        switch ($años) {
            case 1:
                $plazo = '1 año';
                break;
            case 2:
                $plazo = '2 años';
                break;
            case 3:
                $plazo = '3 años';
                break;
            case 4:
                $plazo = '4 años';
                 break;
            case 5:
                 $plazo = '5 años';
                break;
            default:
                $plazo = 'Contrato Invalido';
                break;
        }
        $data = [
            'title' => 'Contrato de ' . $user->name,
            'nombre' => $user->name . ' ' . $user->lastName,
            'empresa' => $empresa->nombre,
            'titular' => $empresa->titular,
            'fecha_notaria' => $empresa->Fecha_notaria,
            'numero_escritura' => $empresa->numero_escritura,
            'folio_mercantil' => $empresa->folio_mercantil,
            'credencial_elector' => $empresa->credencial_elector,
            'testimonio_notarial' => $empresa->testimonio_notarial,
            'rfc_empresa' => $empresa->RFC_empresa,
            'plazo' => $plazo,
            'cantidad' => $cantidad,
            'fecha' => $dt,
            'dia' => $day,
            'tipo_contrato' => $tipo_contrato,
            'proyecto' => $proyecto->proyecto,
            'ciudad' => $proyecto->ciudad,
            'valor' => $proyecto->valor,
            'porcentaje' => $proyecto->porcentaje,
            'name' => $beneficiarios->name,
        ];
        return $data;
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

    

    public function printPDF()
{
    $userid = Auth::user()->id;
    // Obtener la inversión más reciente de la base de datos
    $inversionDB = InversionCliente::where('user_id', $userid)
    ->latest()
    ->first();

    // Obtener la inversión de la sesión
    $inversionSesion = session()->get('inversion');

    // Combinar ambas inversiones usando el operador de fusión de null
    $inversion = $inversionDB ?? $inversionSesion;
    $proyecto = proyecto::all();
    $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
        ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
        ->where('beneficiarios.user_id', '=', $userid)
        ->get();
    $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
    $user = User::where('users.id', Auth::id())
        ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->first();
    $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
    $banco = Banco::where('clave', $clabe)->first();
    $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';

    // Lógica condicional para determinar qué vista cargar
    $viewName = ($userid == 367) ? 'contratos.contratoreymundo' : 'contratos.inversionV1';
    
    // Limpiar el número de cualquier carácter no numérico
    $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);
    
    // Convertir el monto a letras
    $montoLetras = $this->convertirNumeroALetras($montoNumerico);

    // Cargar la vista correcta
    $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras'));

    // Generar el nombre del archivo
    $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
    $folioContrato = $inversion->folio;
    $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';

    // Obtener la ruta completa del directorio de destino
    $directorioDestino = 'C:\Users\Admin\contratos';

    // Verificar si el directorio de destino existe, si no, crearlo
    // (Puedes agregar la lógica para crear el directorio aquí si aún no lo has hecho)

    // Devolver el PDF como una respuesta para su visualización en el navegador
    return $pdf->stream($filename);
}

    
public function printPDFpre()
{
    $userid = Auth::user()->id;
    // Obtener la inversión más reciente de la base de datos
    $inversionDB = InversionCliente::where('user_id', $userid)
    ->latest()
    ->first();

    // Obtener la inversión de la sesión
    $inversionSesion = session()->get('inversion');

    // Combinar ambas inversiones usando el operador de fusión de null
    $inversion = $inversionSesion;
    $proyecto = proyecto::all();
    $preFolio = $inversion->pre_folio;

    // Obtener los beneficiarios de la inversión actual con el mismo pre_folio
    $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
        ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
        ->where('beneficiarios.user_id', '=', $userid)
        ->where('beneficiario_inversi.id_inversion', '=', $preFolio) // Filtrar por el mismo pre_folio
        ->get();
    $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
    $user = User::where('users.id', Auth::id())
        ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->first();
    $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
    $banco = Banco::where('clave', $clabe)->first();
    $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';

    // Lógica condicional para determinar qué vista cargar
    $viewName = 'contratos.precontrato';

    // Cargar la vista correcta
    
    $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre'));

    // Generar el nombre del archivo
    $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
    $folioContrato = $inversion->folio;
    $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';

    // Obtener la ruta completa del directorio de destino
    $directorioDestino = 'C:\Users\Admin\contratos';

    // Verificar si el directorio de destino existe, si no, crearlo
    // (Puedes agregar la lógica para crear el directorio aquí si aún no lo has hecho)


    // Devolver el PDF como una respuesta para su visualización en el navegador
    return $pdf->stream($filename);
}

public function precontrato()
{
    $userid = Auth::user()->id;

    // Obtener la inversión más reciente de la base de datos
    $inversionDB = InversionCliente::where('user_id', $userid)
        ->latest()
        ->first();

    // Obtener la inversión de la sesión
    $inversionSesion = session()->get('inversion');

    // Combinar ambas inversiones usando el operador de fusión de null
    $inversion = $inversionDB ?? $inversionSesion;

    // Asegurarse de que la inversión existe
    if (!$inversion) {
        // Manejar el caso donde no hay una inversión
        return redirect()->back()->with('error', 'No se encontró ninguna inversión.');
    }

    // Asignar $id_inversion desde la inversión obtenida
    $id_inversion = $inversion->id;
    $preFolio = $inversion->pre_folio;
    // Obtener la inversión usando el ID
    $inversion = InversionCliente::where('id', $id_inversion)->first();
    $proyecto = proyecto::all();
    $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
    ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
    ->where('beneficiarios.user_id', '=', $userid)
    ->where('beneficiario_inversi.id_inversion', '=', $preFolio) // Filtrar por el mismo pre_folio
    ->get();
    $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
    $user = User::where('users.id', Auth::id())
        ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->first();
    $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
    $banco = Banco::where('clave', $clabe)->first();
    $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';

    // Lógica condicional para determinar qué vista cargar
    $viewName = 'contratos.inversionV2';

    // Limpiar el número de cualquier carácter no numérico
    $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);

    // Convertir el monto a letras
    $montoLetras = $this->convertirNumeroALetras($montoNumerico);
    $userid = Auth::user()->id;
    $procedencias = Procedencia::where('id_user', $userid)
    ->where('id_inversion', $id_inversion) // Utilizar $id_inversion en lugar de $inversion->id
    ->get();

$textoProcedenciaStr = '';

foreach ($procedencias as $procedencia) {
    if ($procedencia->intitucion == 'Depósito Bancario') {
        $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Institución: {$procedencia->intitucion}</li>";
    } else {
        $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Cuenta Clabe: {$procedencia->cuentaclabe}, Institución: {$procedencia->intitucion}</li>";
    }
}

    // Cargar la vista correcta
    $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras', 'textoProcedenciaStr'));

    // Generar el nombre del archivo
    $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
    $folioContrato = $inversion->folio;
    $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';

    // Obtener la ruta completa del directorio de destino
    $directorioDestino = 'C:\Users\Admin\contratos';

    // Devolver el PDF como una respuesta para su visualización en el navegador
    return $pdf->stream($filename);
}


    public function printContractPDF()
    {
        $userid = Auth::user()->id;

        $inversion = InversionCliente::where('user_id', $userid)
            ->latest()
            ->first();

        $proyecto = Proyecto::all();

        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();

        $user = User::where('users.id', Auth::id())
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();

        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
        $banco = Banco::where('clave', $clabe)->first();
        $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';

        $pdf = PDF::loadView('contratos.contratodaniel', compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre'));
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'recontrato' . $nombreCliente . $folioContrato . '.pdf';

        // Obtener la ruta completa del directorio de destino
        $directorioDestino = 'C:\Users\Admin\contratos';

        // Verificar si el directorio de destino existe, si no, crearlo
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }

        // Guardar una copia del contrato en el directorio de destino
        $pdf->save($directorioDestino . '\\' . $filename);

        return $pdf->stream('Contrato.pdf');
    }



    public function printPDFadmin($id_inversion)
    {
        $proyecto = proyecto::all();
        $inversion = InversionCliente::where('id', $id_inversion)->first();
        $userId = $inversion->user_id;
        $user = User::where('users.id', $userId)
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
               // Limpiar el número de cualquier carácter no numérico
               $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);
        
               // Convertir el monto a letras
               $montoLetras = $this->convertirNumeroALetras($montoNumerico);
             // Obtener el texto de procedencia guardado
             $procedencias = Procedencia::where('id_user', $userId)
        ->where('id_inversion', $id_inversion) // Utilizar $id_inversion en lugar de $inversion->id
        ->get();

    $textoProcedenciaStr = '';

    foreach ($procedencias as $procedencia) {
        if ($procedencia->intitucion == 'Depósito Bancario') {
            $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Institución: {$procedencia->intitucion}</li>";
        } else {
            $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Cuenta Clabe: {$procedencia->cuentaclabe}, Institución: {$procedencia->intitucion}</li>";
        }
    }
    $preFolio = $inversion->pre_folio;
        // Obtenemos los beneficiarios del cliente asociados a la inversión
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiario_inversi.id_inversion', '=', $preFolio)
            ->get();
    
            switch ($inversion->contrato_inversion_id){
                case 1:
                    $proyecto = proyecto::all();
                    $userid = Auth::user()->id;
                    $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
                    $dt = Date::parse($inversion->fecha_inicio)->format('l d F Y');
                    $day = Date::parse($inversion->fecha_inicio)->format('d');
                    $años = (Carbon::parse($inversion->fecha_termino))->diffInYears(Carbon::parse($inversion->fecha_inicio));
                    $cantidad = $inversion->cantidad;
                    $tipo_contrato = $inversion->contrato_inversion_id;
                    $data = Self::crearData($años, $empresa, $user, $cantidad, $dt, $day, $tipo_contrato,$proyecto,$beneficiarios);
                    $pdf = PDF::loadView('pdf_view1', $data);
                    return $pdf->stream('Contrato.pdf');
                    break;
                case 5 :
                    $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
                    $banco = Banco::where('clave', $clabe)->first();
                    $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
        
                    // Verificar el ID del usuario y cargar la vista correspondiente
                    if ($userId == 377) {
                        $pdf = PDF::loadView('contratos.contratoreymundo', compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre'));
                    } else {
                        $pdf = PDF::loadView('contratos.inversionV1', compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'textoProcedenciaStr', 'montoLetras'));
                    }
        
                    return $pdf->stream('contrato-inversion.pdf');
        
                    break;
                    default:
                    $userid = Auth::id();
                    // Verificar si la inversión está en la sesión, si no, obtenerla de la base de datos
                    if (!$inversion) {
                        $inversion = InversionCliente::where('user_id', $userid)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    }
                    $folioPrincipal = substr($inversion->folio, 0, strpos($inversion->folio, '-'));
                    $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
                    $banco = Banco::where('clave', $clabe)->first();
                    $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
                        ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
                        ->where('beneficiarios.user_id', '=', $userid)
                        ->get();
                    $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
                    $inversionBase = InversionCliente::where('folio', $folioPrincipal)->first();
                
                    $cantidadInversionPrincipal = $inversionBase ? str_replace(['$', ','], '', $inversionBase->cantidad) : '0';
                    $cantidadReinversion = str_replace(['$', ','], '', $inversion->cantidad);
                
                    $diferencia = floatval($cantidadInversionPrincipal) - floatval($cantidadReinversion);
                    $diferenciamayor = floatval($cantidadReinversion) - floatval($cantidadInversionPrincipal);
                    $diferenciaFormateada = number_format($diferencia, 2, '.', ',');
                    $diferenciamayorFormateada = number_format($diferenciamayor, 2, '.', ',');
                
                    $currencyCode = 'USD'; // Currency code, adjust as needed
                    $currencies = new ISOCurrencies();
                    $moneyParser = new DecimalMoneyParser($currencies);
                
                    $diferenciamayorNumerico = str_replace(',', '', $diferenciamayorFormateada);
                    $currency = new Currency($currencyCode); // Create a Currency instance
                    $diferenciamayorMoney = $moneyParser->parse($diferenciamayorNumerico, $currency);
                
                    // Validación y selección de la vista correspondiente
                    if ($cantidadInversionPrincipal < $cantidadReinversion) {
                        $pdf = PDF::loadView('contratos.adendummayor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal'));
                    } elseif ($cantidadInversionPrincipal > $cantidadReinversion) {
                        $pdf = PDF::loadView('contratos.adendummenor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal'));
                    } else {
                        $pdf = PDF::loadView('contratos.adendumV1', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal'));
                    }
                
                    // Generar el nombre del archivo
                    $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
                    $folioContrato = $inversion->folio;
                    $filename = 'adendum_' . $nombreCliente . $folioContrato . '.pdf';
                
                    // Obtener la ruta completa del directorio de destino
                    $directorioDestino = 'C:\Users\Admin\contratos';
                
                    // Verificar si el directorio de destino existe, si no, crearlo
                
                    // Resto del código de guardado del contrato en el directorio de destino...
                
                    return $pdf->stream($filename);
                    break;
            }
    }

    public function printPDFControl($id_inversion)
    {
        $userId = Auth::id();
        $user = User::where('users.id', $userId)
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $inversion = InversionCliente::where([
            ['id', $id_inversion],
            ['user_id', $userId],
        ])->first();
        $proyecto = proyecto::all();
        $userid = Auth::user()->id;
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $dt = Date::parse($inversion->fecha_inicio)->format('l d F Y');
        $day = Date::parse($inversion->fecha_inicio)->format('d');
        $años = (Carbon::parse($inversion->fecha_termino))->diffInYears(Carbon::parse($inversion->fecha_inicio));
        $cantidad = $inversion->cantidad;
        $tipo_contrato = $inversion->contrato_inversion_id;
        $proyecto = proyecto::all();
        $data = Self::crearData($años, $empresa, $user, $cantidad, $dt, $day, $tipo_contrato, $proyecto, $beneficiarios);
        $pdf = PDF::loadView('pdf_view1', $data);

        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $filename = 'contrato' . $nombreCliente . $id_inversion . '.pdf';

        // Obtener la ruta completa del directorio de destino
        $directorioDestino = 'C:\Users\Admin\contratos';

        // Verificar si el directorio de destino existe, si no, crearlo
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }

        // Guardar una copia del contrato en el directorio de destino
        $pdf->save($directorioDestino . '\\' . $filename);

        return $pdf->stream($filename);
    }



    public function contratoReinversion()
    {
        $proyecto = proyecto::all();
        $inversion = session()->get('inversion');
        $userid = Auth::id();
        // Verificar si la inversión está en la sesión, si no, obtenerla de la base de datos
        if (!$inversion) {
            $inversion = InversionCliente::where('user_id', $userid)
                ->orderBy('created_at', 'desc')
                ->first();
        }
        $folioPrincipal = substr($inversion->folio, 0, strpos($inversion->folio, '-'));
        $inversionBase = InversionCliente::where('folio', $folioPrincipal)->first();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $user = User::where('users.id', Auth::id())
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
        $banco = Banco::where('clave', $clabe)->first();
        $userid = Auth::user()->id;
        $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
            $penultimaInversion = InversionCliente::where('user_id', $userid)
    ->orderBy('created_at', 'desc')// Omitir la última inversión
    ->first();

        $cantidadInversionPrincipal = str_replace(['$', ','], '', $penultimaInversion->cantidad);
        $cantidadReinversion = str_replace(['$', ','], '', $inversion->cantidad);

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


        $diferencia = floatval($cantidadInversionPrincipal) - floatval($cantidadReinversion);
        $diferenciamayor = floatval($cantidadReinversion) - floatval($cantidadInversionPrincipal);
        $diferenciaFormateada = number_format($diferencia, 2, '.', ',');
        $diferenciamayorFormateada = number_format($diferenciamayor, 2, '.', ',');

        $currencyCode = 'USD'; // Currency code, adjust as needed
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);


        $diferenciamayorNumerico = str_replace(',', '', $diferenciamayorFormateada);
        $currency = new Currency($currencyCode); // Create a Currency instance
        $diferenciamayorMoney = $moneyParser->parse($diferenciamayorNumerico, $currency);


        $cantidadLetras = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $inversion->cantidad)));
        $cantidadLetrasdiferencia = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciaFormateada)));
        $cantidadLetrasmayor = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciamayorFormateada)));

    // Pasar la cantidad en letras a la vista
    if ($cantidadInversionPrincipal < $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.premayor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeInteresesmayor','diferenciamayorFormateada', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } elseif ($cantidadInversionPrincipal > $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.premenor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } else {
        $pdf = PDF::loadView('contratos.preigual', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    }

        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'adendum_' . $nombreCliente . $folioContrato . '.pdf';

        // Obtener la ruta completa del directorio de destino
        $directorioDestino = 'C:\Users\Admin\contratos';


      

        return $pdf->stream($filename);
    }


    
 
    public function showContratoReinversion($id_inversion)
    {
        $proyecto = proyecto::all();
    $inversion = InversionCliente::where('id', $id_inversion)->first();
    $userId = $inversion->user_id;
    $user = User::where('users.id', $userId)
        ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
        ->first();
    $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
           // Limpiar el número de cualquier carácter no numérico
           $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);
           // Convertir el monto a letras
           $montoLetras = $this->convertirNumeroALetras($montoNumerico);
         // Obtener el texto de procedencia guardado
         $procedencias = Procedencia::where('id_user', $userId)
    ->where('id_inversion', $id_inversion) // Utilizar $id_inversion en lugar de $inversion->id
    ->get();

$textoProcedenciaStr = '';

foreach ($procedencias as $procedencia) {
    if ($procedencia->intitucion == 'Depósito Bancario') {
        $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Institución: {$procedencia->intitucion}</li>";
    } else {
        $textoProcedenciaStr .= "<li>Cantidad: {$procedencia->cantidad}, Cuenta Clabe: {$procedencia->cuentaclabe}, Institución: {$procedencia->intitucion}</li>";
    }
}
    
$preFolio = $inversion->pre_folio;
// Obtenemos los beneficiarios del cliente asociados a la inversión
$beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
    ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
    ->where('beneficiario_inversi.id_inversion', '=', $preFolio)
    ->get();
        switch ($inversion->contrato_inversion_id){
            case 1:
                $proyecto = proyecto::all();
                $userid = Auth::user()->id;
                $preFolio = $inversion->pre_folio;
                // Obtenemos los beneficiarios del cliente asociados a la inversión
                $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
                    ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
                    ->where('beneficiario_inversi.id_inversion', '=', $preFolio)
                    ->get();
                $dt = Date::parse($inversion->fecha_inicio)->format('l d F Y');
                $day = Date::parse($inversion->fecha_inicio)->format('d');
                $años = (Carbon::parse($inversion->fecha_termino))->diffInYears(Carbon::parse($inversion->fecha_inicio));
                $cantidad = $inversion->cantidad;
                $tipo_contrato = $inversion->contrato_inversion_id;
                $data = Self::crearData($años, $empresa, $user, $cantidad, $dt, $day, $tipo_contrato,$proyecto,$beneficiarios);
                $pdf = PDF::loadView('pdf_view1', $data);
                return $pdf->stream('Contrato.pdf');
                break;
            case 5 :
                $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
                $banco = Banco::where('clave', $clabe)->first();
                $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
    
                // Verificar el ID del usuario y cargar la vista correspondiente
                if ($userId == 377) {
                    $pdf = PDF::loadView('contratos.contratoreymundo', compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre'));
                } else {
                    $pdf = PDF::loadView('contratos.inversionV1', compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'textoProcedenciaStr', 'montoLetras'));
                }
    
                return $pdf->stream('contrato-inversion.pdf');
    
                break;
                default:
                $userid = Auth::id();
                // Verificar si la inversión está en la sesión, si no, obtenerla de la base de datos
                if (!$inversion) {
                    $inversion = InversionCliente::where('user_id', $userid)
                        ->orderBy('created_at', 'desc')
                        ->first();
                }
                $folioPrincipal = substr($inversion->folio, 0, strpos($inversion->folio, '-'));
                $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
                $banco = Banco::where('clave', $clabe)->first();
                $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
                    ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
                    ->where('beneficiarios.user_id', '=', $userid)
                    ->get();
                $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
                $inversionBase = InversionCliente::where('folio', $folioPrincipal)->first();
            
                $cantidadInversionPrincipal = $inversionBase ? str_replace(['$', ','], '', $inversionBase->cantidad) : '0';
                $cantidadReinversion = str_replace(['$', ','], '', $inversion->cantidad);
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

                $diferencia = floatval($cantidadInversionPrincipal) - floatval($cantidadReinversion);
                $diferenciamayor = floatval($cantidadReinversion) - floatval($cantidadInversionPrincipal);
                $diferenciaFormateada = number_format($diferencia, 2, '.', ',');
                $diferenciamayorFormateada = number_format($diferenciamayor, 2, '.', ',');
                $penultimaInversion = InversionCliente::where('user_id', $userid)
                ->orderBy('created_at', 'desc')// Omitir la última inversión
                ->first();
                $currencyCode = 'USD'; // Currency code, adjust as needed
                $currencies = new ISOCurrencies();
                $moneyParser = new DecimalMoneyParser($currencies);
            
                $diferenciamayorNumerico = str_replace(',', '', $diferenciamayorFormateada);
                $currency = new Currency($currencyCode); // Create a Currency instance
                $diferenciamayorMoney = $moneyParser->parse($diferenciamayorNumerico, $currency);


                $cantidadLetras = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $inversion->cantidad)));
        $cantidadLetrasdiferencia = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciaFormateada)));
        $cantidadLetrasmayor = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciamayorFormateada)));

    // Pasar la cantidad en letras a la vista
    if ($cantidadInversionPrincipal < $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.adendummayor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeInteresesmayor','diferenciamayorFormateada', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } elseif ($cantidadInversionPrincipal > $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.adendummenor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } else {
        $pdf = PDF::loadView('contratos.adendumV1', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    }
            

                // Generar el nombre del archivo
                $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
                $folioContrato = $inversion->folio;
                $filename = 'adendum_' . $nombreCliente . $folioContrato . '.pdf';
            
                // Obtener la ruta completa del directorio de destino
                $directorioDestino = 'C:\Users\Admin\contratos';
            
                // Verificar si el directorio de destino existe, si no, crearlo
            
                // Resto del código de guardado del contrato en el directorio de destino...
            
                return $pdf->stream($filename);
                break;
        }
    }


    public function cancelacion()
    {
        $userid = Auth::user()->id;
        // Obtener la inversión más reciente de la base de datos
        $inversionDB = InversionCliente::where('user_id', $userid)
        ->latest()
        ->first();
    
        // Obtener la inversión de la sesión
        $inversionSesion = session()->get('inversion');
    
        // Combinar ambas inversiones usando el operador de fusión de null
        $inversion = $inversionDB ?? $inversionSesion;
        $proyecto = proyecto::all();
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $user = User::where('users.id', Auth::id())
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
        $banco = Banco::where('clave', $clabe)->first();
        $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
    
        // Lógica condicional para determinar qué vista cargar
        $viewName = ($userid == 367) ? 'contratos.contratoreymundo' : 'contratos.cancelacion';
        
        // Limpiar el número de cualquier carácter no numérico
        $montoNumerico = preg_replace('/[^0-9.]/', '', $inversion->cantidad);
        
        // Convertir el monto a letras
        $montoLetras = $this->convertirNumeroALetras($montoNumerico);
    
        // Cargar la vista correcta
        $pdf = PDF::loadView($viewName, compact('inversion', 'empresa', 'user', 'proyecto', 'beneficiarios', 'bancoNombre', 'montoLetras'));
    
        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'contrato' . $nombreCliente . $folioContrato . '.pdf';
    
        // Obtener la ruta completa del directorio de destino
        $directorioDestino = 'C:\Users\Admin\contratos';
    
        // Verificar si el directorio de destino existe, si no, crearlo
        // (Puedes agregar la lógica para crear el directorio aquí si aún no lo has hecho)
    
        // Devolver el PDF como una respuesta para su visualización en el navegador
        return $pdf->stream($filename);
    }



    public function contratoReinversionpre()
    {
        $proyecto = proyecto::all();
        $inversion = session()->get('inversion');
        $userid = Auth::id();
        // Verificar si la inversión está en la sesión, si no, obtenerla de la base de datos
        if (!$inversion) {
            $inversion = InversionCliente::where('user_id', $userid)
                ->orderBy('created_at', 'desc')
                ->first();
        }
        $folioPrincipal = substr($inversion->folio, 0, strpos($inversion->folio, '-'));
        $inversionBase = InversionCliente::where('folio', $folioPrincipal)->first();
        $empresa = Empresa_inversion::where('id', $inversion->empresa_inversion_id)->first();
        $user = User::where('users.id', Auth::id())
            ->rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
            ->first();
        $clabe = substr($inversion->cuenta_pago_rendimientos, 0, 3);
        $banco = Banco::where('clave', $clabe)->first();
        $userid = Auth::user()->id;
        $bancoNombre = $banco ? $banco->banco_nombre : 'Banco Desconocido';
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
            ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje')
            ->where('beneficiarios.user_id', '=', $userid)
            ->get();
            $penultimaInversion = InversionCliente::where('user_id', $userid)
    ->orderBy('created_at', 'desc')// Omitir la última inversión
    ->first();

        $cantidadInversionPrincipal = str_replace(['$', ','], '', $penultimaInversion->cantidad);
        $cantidadReinversion = str_replace(['$', ','], '', $inversion->cantidad);

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


        $diferencia = floatval($cantidadInversionPrincipal) - floatval($cantidadReinversion);
        $diferenciamayor = floatval($cantidadReinversion) - floatval($cantidadInversionPrincipal);
        $diferenciaFormateada = number_format($diferencia, 2, '.', ',');
        $diferenciamayorFormateada = number_format($diferenciamayor, 2, '.', ',');

        $currencyCode = 'USD'; // Currency code, adjust as needed
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);


        $diferenciamayorNumerico = str_replace(',', '', $diferenciamayorFormateada);
        $currency = new Currency($currencyCode); // Create a Currency instance
        $diferenciamayorMoney = $moneyParser->parse($diferenciamayorNumerico, $currency);


        $cantidadLetras = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $inversion->cantidad)));
        $cantidadLetrasdiferencia = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciaFormateada)));
        $cantidadLetrasmayor = $this->cantidadALetras(floatval(str_replace(['$', ','], '', $diferenciamayorFormateada)));

    // Pasar la cantidad en letras a la vista
    if ($cantidadInversionPrincipal < $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.premayor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeInteresesmayor','diferenciamayorFormateada', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } elseif ($cantidadInversionPrincipal > $cantidadReinversion) {
        $pdf = PDF::loadView('contratos.premenor', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    } else {
        $pdf = PDF::loadView('contratos.preigual', compact('inversion', 'empresa', 'user', 'inversionBase', 'proyecto', 'beneficiarios', 'bancoNombre', 'diferenciaFormateada', 'diferenciamayor', 'folioPrincipal','penultimaInversion','mensajeIntereses', 'cantidadLetras','cantidadLetrasdiferencia','cantidadLetrasmayor'));
    }

        // Generar el nombre del archivo
        $nombreCliente = Str::lower($user->name); // Convertir el nombre del cliente a minúsculas
        $folioContrato = $inversion->folio;
        $filename = 'adendum_' . $nombreCliente . $folioContrato . '.pdf';

        // Obtener la ruta completa del directorio de destino
        $directorioDestino = 'C:\Users\Admin\contratos';


      

        return $pdf->stream($filename);
    }


    public function numeroALetras($num)
{
    // Definición de arrays para las unidades, decenas y centenas
    $unidades = [
        '', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE',
        'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE',
        'DIECIOCHO', 'DIECINUEVE', 'VEINTE', 'VEINTIUNO', 'VEINTIDOS', 'VEINTITRES',
        'VEINTICUATRO', 'VEINTICINCO', 'VEINTISEIS', 'VEINTISIETE', 'VEINTIOCHO', 'VEINTINUEVE', 
        'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA'
    ];

    $centenas = ['CIEN', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS', 'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'];

    // Manejar valores negativos
    if ($num < 0) {
        return 'MENOS ' . $this->numeroALetras(-$num);
    }

    // Manejar números más grandes que un millón
    if ($num >= 1000000) {
        $millones = (int)($num / 1000000);
        $resto = $num % 1000000;
        return $this->numeroALetras($millones) . ' MILLÓN' . ($millones > 1 ? 'ES' : '') . ($resto > 0 ? ' ' . $this->numeroALetras($resto) : '');
    }

    // Convertir números menores a un millón
    if ($num < 30) {
        return $unidades[$num];
    } elseif ($num < 100) {
        return $unidades[30 + ($num - 30)] . ' Y';
    } elseif ($num < 1000) {
        $c = (int)($num / 100);
        $r = $num % 100;
        return $centenas[$c - 1] . ($r ? ' ' . $this->numeroALetras($r) : '');
    } elseif ($num < 1000000) {
        $m = (int)($num / 1000);
        $r = $num % 1000;
        return $this->numeroALetras($m) . ' MIL' . ($r ? ' ' . $this->numeroALetras($r) : '');
    }

    return 'NÚMERO DEMASIADO GRANDE'; // Para cantidades mayores a un millón
}

public function cantidadALetras($cantidad)
{
    $parteEntera = intval($cantidad);
    $parteDecimal = round(($cantidad - $parteEntera) * 100);
    
    // Convertir la parte entera a letras
    $letras = $this->numeroALetras($parteEntera);
    
    // Agregar "DE" si la cantidad es un millón o más
    if ($parteEntera >= 1000000) {
        return strtoupper($letras . ' DE PESOS ' . str_pad($parteDecimal, 2, '0', STR_PAD_LEFT) . '/100 M.N.');
    }

    return strtoupper($letras . ' PESOS ' . str_pad($parteDecimal, 2, '0', STR_PAD_LEFT) . '/100 M.N.');
}

    


    
}
