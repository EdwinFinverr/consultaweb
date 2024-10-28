<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class photos extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'photos';
    protected $fillable = ['path','user_id'];
}