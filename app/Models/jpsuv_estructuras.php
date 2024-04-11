<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jpsuv_estructuras extends Model
{
    use HasFactory;

    protected $fillable = ['estj_nac','estj_cedula','estj_nombres','estj_telefono', 'estj_direccion','estj_estado', 'estj_municipio','estj_parroquia','estj_centro','estj_car_id','estj_nivel_id','estj_nivel','estj_usuario_creo','estj_municipio_usu','estj_tipo_reg'];
}
