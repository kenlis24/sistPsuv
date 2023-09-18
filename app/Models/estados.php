<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estados extends Model
{
    use HasFactory;

    public function municipios()
    {
        return $this->hasMany(municipios::class, 'mun_edo_id');
    }
}
