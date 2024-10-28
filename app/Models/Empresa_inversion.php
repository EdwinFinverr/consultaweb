<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa_inversion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'empresa_inversion';
    protected $fillable = ['nombre', 'titular', 'credencial_elector', 'fecha_notaria', 'numero_escritura', 'folio_mercantil', 'testimonio_notarial', 'RFC_empresa', 'activa'];
    public static function obtenerActiva()
    {
        return Empresa_inversion::where('activa', true);
    }
}
