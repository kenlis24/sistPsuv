<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cneDatos extends Model
{
    use HasFactory;

    protected $fillable = ['cne_estado','cne_municipio', 'cne_cod_centro', 'cne_centro','cne_nac','cne_cedula','cne_nombres','cne_sexo','cne_fecha_nac'];
}
