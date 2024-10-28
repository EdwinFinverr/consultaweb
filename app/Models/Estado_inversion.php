<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado_inversion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'estado_inversion';
    protected $fillable = ['estado'];
}