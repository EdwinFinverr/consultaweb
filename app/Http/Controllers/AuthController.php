<?php

namespace App\Http\Controllers;

use App\Models\DatosUsuario;
use App\Models\photos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Session;
use App\Models\Beneficiarios;
use App\Models\Contrato_inversion;
use App\Models\Empresa_inversion;
use App\Models\Estado_inversion;
use App\Mail\MailRegistro;
use App\Http\Requests\AlmacenarBeneficiario;
use App\InversionCliente;
use App\Notifications\WelcomeEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use  Illuminate\Validation\Validator;
use App\Mail\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use App\Mail\MailAltaCliente;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function postRegistration(Request $request)
    {
        request()->validate([
            'numero_ext' => 'required',
            'colonia' => 'required',
            'municipio' => 'required',
            'ciudad' => 'required',
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:8', 'confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'address' => 'required',
            'postalcode' => 'required|digits:5',
            'telephone' => 'required|min:10|max:10',
            'birthday' => 'required|date|before:-18 years',
            'rfc' => ['required', 'regex:/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{3})$/', 'unique:datos_usuario'],
            'terms' => 'required|accepted',
        ]);
        $data = $request->all();
        $lastId = $this->createUser($data);
        $this->createUserData($data, $lastId);

        return Redirect::to("login")->withSuccess('Has creado tu cuenta, verifica tu correo para poder continuar');
    }

    public function createUser(array $data)
    {
        $lastId = User::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => '2',
            'clave_asesor' => '',
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
             'password_change_required' => true,
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
            'address' => $data['address'],
            'email' => $data['email'],
            'numero_ext' => $data['numero_ext'],
            'num_int' => $data['numero_int'],
            'colonia' => $data['colonia'],
            'postalcode' => $data['postalcode'],
            'municipio' => $data['municipio'],
            'ciudad' => $data['ciudad'],
            'telephone' => $data['telephone'],
            'birthday' => $data['birthday'],
            'rfc' => $data['rfc'],
            'addressphoto' => '1',
            'fiscalphoto' => '1',
            'idphoto' => '1',
            'verified' => '0',
            'innerID' => 'PENDIENTE',
            'clave_asesor' => '',
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function edit($id){
        $usuario=User::findOrFail($id);
        return $usuario;
    }

    public function updateDocument(Request $request ,DatosUsuario $documentos){
        request()->validate([
            'idphoto' => 'required|image|max:2048',
            'idphotoback' => 'required|image|max:2048',
            'addressphoto' => 'required|image|max:2048',
        ]);
        $documentos->update([
            'addressphoto' => true,
            'idphoto' => true,
            'verified' => false,
        ]);
        $data = $request->all();
        $lastId = $this->createUser($data);
        $this->createUserData($data, $lastId);
        $image = $request->file('idphoto');
        $new_name = rand() . $data['name'] . $data['lastName'] . 'Id.' . $image->getClientOriginalExtension();
        $image->move(public_path('ids'), $new_name);
        $photo = new photos();
        $photo->user_id = $lastId;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
        $imageidback = $request->file('idphotoback');
        $new_name = rand() . $data['name'] . $data['lastName'] . 'IdBack.' . $imageidback->getClientOriginalExtension();
        $imageidback->move(public_path('ids'), $new_name);
        $photo = new photos();
        $photo->user_id = $lastId;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
        $imageaddress = $request->file('addressphoto');
        $new_nameaddress = rand() . $data['name'] . $data['lastName'] . 'address.' . $image->getClientOriginalExtension();
        $imageaddress->move(public_path('addressPhotos'), $new_nameaddress);
        $photo = new photos();
        $photo->user_id = $lastId;
        $photo->path = 'addressPhotos/' . $new_nameaddress;
        $photo->save();

        return redirect()->route('documentacion', with($documentos->lastId))->with('success', 'Se actualizo los documentos');
    }



    public function indexusuario( )
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
            $datos = DatosUsuario::where('user_id', $userid)->get();
            return view('photos')->with('usuarios',$users , 'datos' , $datos);
            //return view('informacioncliente', ['usuarios' => $users, 'empresas' => $empresas, 'contratos' => $contratos, 'inversiones' => $inversiones, 'beneficiarios' => $beneficiarios, 'estados' => $estados]);
    }

    public function getGallery($id)
    {
        $fotos = photos::where('user_id', $id)->get();
        return view('gallryase', ['fotos' => $fotos]);
    }

    public function update(Request $request, $id){



        $datos = DatosUsuario::find($id);
        $image = $request->file('idphoto');
        $new_name = rand() . $datos['name'] . $datos['lastName'] . 'Id.' . $image->getClientOriginalExtension();
        $image->move(public_path('ids'), $new_name);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'ids/' . $new_name;
        $photo->save();
        $imageaddress = $request->file('addressphoto');
        $new_nameaddress = rand() . $datos['name'] . $datos['lastName'] . 'address.' . $image->getClientOriginalExtension();
        $imageaddress->move(public_path('addressPhotos'), $new_nameaddress);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'addressPhotos/' . $new_nameaddress;
        $photo->save();
        $imagefiscal = $request->file('fiscalphoto');
        $new_namefiscal = rand() . $datos['name'] . $datos['lastName'] . 'fiscal.' . $image->getClientOriginalExtension();
        $imagefiscal->move(public_path('fiscalphoto'), $new_namefiscal);
        $photo = new photos();
        $photo->user_id = $id;
        $photo->path = 'fiscalphoto/' . $new_namefiscal;
        $photo->save();

        return redirect()->route('datoscliente')->with("success");

    }



    public function postRegistrationAsesor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        $data = $request->all();
        $passwordTemporal = Str::random(8);
        $lastId = $this->createAsesor($data, $passwordTemporal);
        $this->createAsesorData($data, $lastId);
        $user = User::find($lastId);
        if ($user) {
            Mail::to($user)->send(new MailAltaCliente($user, $passwordTemporal));
            return Redirect::to("registro/asesoralta")->withSuccess('Se creo el Asesor');
        }
        return Redirect::to("registro/asesoralta")->withSuccess('Se creo el Asesor');



    }


    public function createAsesor(array $data, string $password)
    {
        $lastId = User::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => '3',
            'estatus' => '1',
            'clave_asesor' => $data['clave_asesor'],
            'password' => Hash::make($password),
            'password_change_required' => true,
        ]);

        $user = User::find($lastId);
        event(new Registered($user));
        return $lastId;
    }

    public function createAsesorData(array $data, int $lastId)
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

    public function updateClave($id)
{
    $usuario = User::findOrFail($id);
    $usuario->clave_asesor = request()->input('clave_asesor');
    $usuario->save();

    return redirect()->back()->with('success', 'Clave de asesor actualizada correctamente.');
}

    public function eliminar($id)
    {
        $user = User::find($id);
        if ($user) {
            // Eliminar de User
            $user->delete();

            // También eliminar de DatosUsuario si existe
            $datosUsuario = DatosUsuario::where('user_id', $id)->first();
            if ($datosUsuario) {
                $datosUsuario->delete();
            }

            return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
        }
        return redirect()->back()->withErrors('No se encontró el usuario.');
    }
}