<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato_inversion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'contrato_inversion';
    protected $fillable = ['tipo'];
}