<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends model
{
    protected $primaryKey = 'id';
    protected $table = 'datos_usuario';
      protected $fillable = ['user_id', 'lastName', 'address', 'email','cuenta_transferencia', 'postalcode', 'telephone', 'birthday', 'rfc', 'idphoto', 'addressphoto', 'verified', 'innerID','asesor_id', 'numero_cuenta','fiscalphoto', 'asesor','estatus','numero_ext','colonia','municipio','ciudad','num_int','email_token'];

}