<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jefe_familias extends Model
{
    use HasFactory;

    protected $fillable = ['jfal_nac','jfal_cedula','jfal_nombres','jfal_telefono','jfal_direccion','jfal_estado','jfal_municipio','jfal_parroquia','jfal_centro ','jfal_tipo_reg','jfal_calle_id','jfal_usuario_creo'];
}
