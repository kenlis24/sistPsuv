<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agrupaciones_elecs extends Model
{
    use HasFactory;

    public function parroquia()
    {
        return $this->belongsTo(parroquias::class,  'agr_par_id');
    }
}
