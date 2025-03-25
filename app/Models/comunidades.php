<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comunidades extends Model
{
    use HasFactory;

    protected $fillable = ['com_codigo','com_nombre', 'com_estado', 'com_agr_id'];

    public function agrupaciones()
    {
        return $this->belongsTo(agrupaciones::class, 'com_agr_id');
    }

    public function calles()
    {
        return $this->hasMany(calles::class, 'cal_com_id');
    }
}
