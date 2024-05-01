<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sector_cargos extends Model
{
    use HasFactory;

    protected $fillable = ['secar_cargo', 'secar_cantidad', 'secar_estado'];
}
