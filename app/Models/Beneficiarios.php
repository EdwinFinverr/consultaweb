<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiarios extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'beneficiarios';
    protected $fillable = ['user_id','name','lastName' ,'relationship','edad',];
}