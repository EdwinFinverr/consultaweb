<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'banco';
    protected $fillable = ['clave','banco_nombre',];
}