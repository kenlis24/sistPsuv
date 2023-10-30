<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargos extends Model
{
    use HasFactory;

    protected $fillable = ['car_cargo','car_nivel', 'car_cantidad', 'car_estado'];
}
