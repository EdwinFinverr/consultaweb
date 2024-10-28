<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosCliente extends model
{
    protected $primaryKey = 'id';
    protected $table = 'datos_usuario';
    protected $fillable = ['user_id', 'lastName'];

}