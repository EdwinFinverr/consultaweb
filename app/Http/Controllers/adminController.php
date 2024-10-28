<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario_inversion;
use App\Models\Beneficiarios;
use App\Models\Contrato_inversion;
use App\Models\Empresa_inversion;
use App\Models\Estado_inversion;
use App\Models\InversionCliente;
use App\Models\photos;
use Illuminate\Http\Request;
use Redirect;
use App\Models\DatosUsuario;
use App\Http\Requests\AlmacenarBeneficiario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Barryvdh\DomPDF\Facade\Pdf;

class adminController extends Controller
{
    public function getBeneficiario($id)
    {
        $beneficiarios = Beneficiarios::where('user_id', '=', $id)->get();
        return view('beneficiarios', ['beneficiarios' => $beneficiarios]);
    }

    public function store(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'message' => 'El correo electrónico o la contraseña es incorrecta, por favor vuelva a intentar',
            ]);
        }
        if (auth()->attempt($credentials)) {
            if ($user->role == '1') {
                return redirect()->route('administrador');
            } else if ($user->role == '2') {
                // Verificar si el usuario necesita cambiar la contraseña
                if (empty($user->password)) {
                    return redirect()->route('actualizar', ['id' => $user->id])->with('passwordUpdate', true);
                }
                $datos = DatosUsuario::where('user_id', $user->id)->first();
                if ($datos && empty($datos->rfc)) {
                    // Redirigir al usuario a la página de cambio de contraseña
                    return redirect()->route('actualizar', ['id' => $user->id])->with('passwordUpdate', true);
                } else {
                    // Redirigir al lobby para el usuario con rol 2
                    return redirect()->route('lobby');
                }
            } else if ($user->role == '3') {
                $user = Auth::user();
                if ($user->password_change_required) {
                    // Redirigir al usuario a la página de cambio de contraseña
                    return redirect()->route('actualizarase', ['id' => $user->id])->with('passwordUpdate', true);
                } else {
                    // Redirigir al lobby para el usuario con rol 2
                    return redirect()->route('asesor');
                }
            }
        }
        return back()->withErrors([
            'message' => 'El correo electrónico o la contraseña es incorrecta, por favor vuelva a intentar',
        ]);
    }





    public function index(Request $request)
    {
        if ($request) {
            // Obtener el término de búsqueda del request
            $query = trim($request->get('search'));
    
            // Realizar la consulta
            $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                ->where(function($queryBuilder) use ($query) {
                    // Buscar en el nombre
                    $queryBuilder->where('users.name', 'LIKE', '%' . $query . '%')
                        // Buscar en el apellido
                        ->orWhere('datos_usuario.lastName', 'LIKE', '%' . $query . '%')
                        // Buscar por el nombre del asesor (puedes adaptar esto según cómo esté representado el asesor en tu base de datos)
                        ->orWhere('datos_usuario.asesor', 'LIKE', '%' . $query . '%');
                })
                ->where('users.role', 2)
                ->paginate(5);
    
            return view('clienteadmin', ['usuarios' => $users, 'search' => $query]);
        }
    }
    
    public function indexinfo($id)
    {
        $users = User::rightJoin('datos_usuario', 'users.id', '=', 'datos_usuario.user_id')
                      ->where('user_id', $id)
                      ->paginate(50);
        
        $inversiones = InversionCliente::where('user_id', '=', $id)->get();
    
        // Obtener la lista de asesores (role 3)
        $asesores = User::where('role', 3)->get();
    
        return view('infoclienteadm')->with(['usuarios' => $users, 'inversiones' => $inversiones, 'asesores' => $asesores]);
    }
    
    
        //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);


    public function getInversiones($id)
    {

        $inversiones = InversionCliente::where('user_id', '=', $id)
            ->paginate(3);
        return view('inversiones', ['idCliente' => $id, 'inversiones' => $inversiones]);
    }
    public function getUserData($id){
        $beneficiarios = Beneficiarios::join('beneficiario_inversi', 'beneficiarios.id', '=', 'beneficiario_inversi.id_beneficiario')
    ->select('beneficiarios.name', 'beneficiarios.lastName', 'beneficiarios.relationship', 'beneficiario_inversi.porcentaje', 'beneficiario_inversi.id_inversion')
    ->where('beneficiarios.user_id', '=', $id)
    ->get();
        $inversiones = InversionCliente::where('user_id', '=', $id)->get();
        return view('userData',['beneficiarios' => $beneficiarios, 'inversiones' => $inversiones] );
        return view('clienteData',['beneficiarios' => $beneficiarios, 'inversiones' => $inversiones] );
    }
    public function getGallery($id)
    {
        $fotos = photos::where('user_id', $id)->get();
        return view('gallery', ['fotos' => $fotos]);
    }

    public function createEmpresa(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'titular' => 'required',
            'CElector' => 'required',
            'FNotaria' => 'required',
            'NEscritura' => 'required',
            'FMercantil' => 'required',
            'TNotarial' => 'required',
            'RFCEmpresa' => 'required',
        ]);
        Empresa_inversion::create([
            'nombre' => $request->nombre,
            'titular' => $request->titular,
            'credencial_elector' => $request->CElector,
            'fecha_notaria' => $request->FNotaria,
            'numero_escritura' => $request->NEscritura,
            'folio_mercantil' => $request->FMercantil,
            'testimonio_notarial' => $request->TNotarial,
            'RFC_empresa' => $request->RFCEmpresa,
            'activa' => 0,
        ]);
        return Redirect::to("registro/lobby")->withSuccess('La empresa fue registrada con exito');
    }
    public function createContrato(Request $request)
    {
        request()->validate([
            'tipo' => 'required',
        ]);
        Contrato_inversion::create([
            'tipo' => $request->tipo,
        ]);
        return Redirect::to("registro/lobby")->withSuccess('El contrato fue registrado con exito');
    }
    public function createEstado(Request $request)
    {
        request()->validate([
            'estado' => 'required',
        ]);
        Estado_inversion::create([
            'estado' => $request->estado,
        ]);
        return Redirect::to("registro/lobby")->withSuccess('El estado fue registrado con exito');
    }

    public function activateEmpresa(Request $request)
    {

        request()->validate([
            'id' => 'required',
        ]);
        Empresa_inversion::where('activa', 1)
            ->update(['activa' => 0]);
        $empresa = Empresa_inversion::find($request->id);
        $empresa->activa = 1;
        $empresa->save();
        return Redirect::to("registro/lobby")->withSuccess('La empresa fue Activada con exito');
    }
    public function showInvestment(InversionCliente $inversion){
        $empresas = Empresa_inversion::all();
        $contratos = Contrato_inversion::all();
        $estados = Estado_inversion::all();
        return view('verInversion', compact('inversion', 'empresas', 'contratos', 'estados'));
    }
    public function editInvestment(InversionCliente $inversion){
        $empresas = Empresa_inversion::all();
        $contratos = Contrato_inversion::all();
        $estados = Estado_inversion::all();
        return view('editarInversion', compact('inversion', 'empresas', 'contratos', 'estados'));
    }
    public function deleteInvestment(InversionCliente $inversion) {
        // Aquí deberías implementar la lógica para eliminar la inversión
        $inversion->delete();
    
        // Redirige a la ruta 'userData' pasando el ID del usuario
        return redirect()->route('userData', [$inversion->user_id])
                         ->with('success', 'Inversión eliminada correctamente');
    }
    public function updateInvestment(Request $request ,InversionCliente $inversion){
        $request->validate([
            'folio' => 'required',
            'cantidad' => 'required',
            'tasa_mensual' => 'required',
            'cuenta_pago_rendimientos' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date',
            'empresa_inversion_id' => 'required|numeric',
            'contrato_inversion_id' => 'required|numeric',
            'estado_inversion_id' => 'required|numeric'
        ]);
        $inversion->update([
            'folio' => $request->folio,
            'cantidad' => $request->cantidad,
            'tasa_mensual' => $request->tasa_mensual,
            'cuenta_pago_rendimientos' => $request->cuenta_pago_rendimientos,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_termino' => $request->fecha_termino,
            'empresa_inversion_id' => $request->empresa_inversion_id,
            'contrato_inversion_id' => $request->contrato_inversion_id,
            'estado_inversion_id' => $request->estado_inversion_id
        ]);
        return redirect()->route('userData', with($inversion->user_id))->with('success', 'Se actualizó la inversión');
    }



    public function indexinversion(Request $request, $id )
    {


        if ($request) {
            $query = trim($request->get('search'));

            $inversiones = InversionCliente::where('folio', 'LIKE', '%' . $query . '%')
                ->where('user_id', '=', $id)
                ->paginate(5);


            return view('invadmin', ['inversiones' => $inversiones, 'search' => $query]);
        }

    }

    public function indexasesor(Request $request)
    {
        $query = trim($request->get('search'));
    
        // Ajustar la consulta para obtener usuarios correctamente
        $users = User::where('name', 'LIKE', '%' . $query . '%')
            ->where('role', 3)
            ->paginate(5);
    
        return view('asesoralta', ['usuarios' => $users, 'search' => $query]);
    }



    public function baja($id){
        $fecha = Carbon::now();
        $user = User::find($id);
        $user->estatus = '2';
        $user->fecha_terminado = $fecha;
        $user->save();
        return redirect()->route('asesoralta')->with("success","Validacion Actualizada");
    }

    public function activo($id){
        $fecha = Carbon::now();
        $user = User::find($id);
        $user->estatus = '1';
        $user->fecha_terminado = $fecha;
        $user->save();
        return redirect()->route('asesoralta')->with("success","Validacion Actualizada");
    }

    public function updateDatos(Request $request, $id)
{
    // Buscar el cliente en la tabla DatosUsuario
    $cliente = DatosUsuario::findOrFail($id);
    
    // Actualizar los campos existentes
    $cliente->rfc = $request->input('rfc');
    $cliente->birthday = $request->input('birthday');
    $cliente->address = $request->input('address');
    $cliente->numero_ext = $request->input('numero_ext');
    $cliente->num_int = $request->input('numero_int');
    $cliente->colonia = $request->input('colonia');
    $cliente->postalcode = $request->input('postalcode');
    $cliente->municipio = $request->input('municipio');
    $cliente->ciudad = $request->input('ciudad');
    $cliente->telephone = $request->input('telephone');

    // Si se selecciona un asesor, actualizar asesor_id y asesor
    if ($request->has('asesor_id')) {
        $asesor = User::where('id', $request->input('asesor_id'))
                        ->where('role', 3) // Asegurarse de que es un asesor
                        ->first();

        if ($asesor) {
            $cliente->asesor_id = $asesor->id;
            $cliente->asesor = $asesor->clave_asesor; // Guardar el clave_asesor
        }
    }

    // Guardar los cambios en la base de datos
    $cliente->save();

    // Redirigir con un mensaje de éxito
    return redirect()->route('clienteadmin')->with("success", "Datos Actualizados");
}


    
    public function pdf(){


        $pdf = Pdf::loadView('pdfprueba');
        set_time_limit(120);
        return $pdf->stream();

    }

}