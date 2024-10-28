<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiario_inversion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'beneficiario_inversi';
    protected $fillable = ['id_user','id_inversion','id_beneficiario','porcentaje' ,'relationship','name','edad',];
}