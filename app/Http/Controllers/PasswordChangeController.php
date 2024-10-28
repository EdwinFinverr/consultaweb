<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PasswordChangeController extends Controller
{
    public function showChangeForm($id)
{
    return view('change', ['id' => $id]);
}

public function change(Request $request)
{
    $request->validate([
        'id' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::find($request->input('id'));

    if (!$user) {
        return redirect()->route('lobby')->with('error', 'Usuario no encontrado.');
    }

    $user->password = bcrypt($request->input('password'));
    $user->password_change_required = false;
    $user->save();

    dd($user); // Agrega esta línea para verificar el objeto $user actualizado

    return redirect()->route('lobby')->with('success', 'Contraseña actualizada correctamente.');
}
}