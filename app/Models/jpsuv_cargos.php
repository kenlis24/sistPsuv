<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jpsuv_cargos extends Model
{
    use HasFactory;

    protected $fillable = ['carj_cargo','carj_nivel', 'carj_cantidad', 'carj_estado'];
}
