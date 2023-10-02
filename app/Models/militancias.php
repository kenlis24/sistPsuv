<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class militancias extends Model
{
    use HasFactory;

    protected $fillable = ['mil_nac','mil_cedula', 'mil_nombres', 'mil_apellidos', 'mil_telefono', 'mil_municipio','mil_parroquia','mil_centro','mil_tipo_reg','mil_fecha', 'mil_id', 'mil_tipo_nivel','mil_usua_crea', 'mil_eve_id'];

    
    public function evento()
    {
        //return $this->belongsToMany(instituciones::class,  'prog_inst_id', 'prog_inst_id_es');
        return $this->belongsTo(eventos::class, 'mil_eve_id', 'id');
    }
}
