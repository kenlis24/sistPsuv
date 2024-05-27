<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poblacion_familias extends Model
{
    use HasFactory;

    protected $fillable = ['pofa_nac','pofa_cedula','pofa_nombres','pofa_telefono' ,'pofa_fech_nac','pofa_estado','pofa_municipio','pofa_parroquia','pofa_centro','pofa_tipo_reg','pofa_calle_id','pofa_jefe_id','pofa_usuario_creo','pofa_municipio_usu'];

}
