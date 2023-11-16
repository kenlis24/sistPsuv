<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estructuras extends Model
{
    use HasFactory;

    protected $fillable = ['est_nac','est_cedula','est_nombres','est_telefono', 'est_direccion','est_estado', 'est_municipio','est_parroquia','est_centro','est_car_id','est_nivel_id','est_nivel','est_usuario_creo','est_municipio_usu','est_tipo_reg'];
}
