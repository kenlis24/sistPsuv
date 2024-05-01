<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectores_personas extends Model
{
    use HasFactory;

    protected $fillable = ['secp_nac', 'secp_cedula','secp_nombres','secp_telefono','secp_estado','secp_municipio','secp_parroquia','secp_centro','secp_tipo_reg','secp_sec_id','secp_cargos_id','secp_municipio_carga','secp_usuario_creo'];
    
}
