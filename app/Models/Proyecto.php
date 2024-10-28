<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'proyecto';
    protected $fillable = ['proyecto','ciudad','valor' ,'porcentaje',];
}
