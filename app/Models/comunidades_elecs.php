<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comunidadesElecs extends Model
{
    use HasFactory;

    public function agrupaciones_elecs()
    {
        return $this->belongsTo(agrupaciones_elecs::class, 'com_agr_id');
    }

}
