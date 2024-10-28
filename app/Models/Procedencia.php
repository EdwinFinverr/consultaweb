<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedencia extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'procedencia';
    protected $fillable = ['id_user','id_inversion','cantidad','cuentaclabe' ,'intitucion','aprobado',];
}