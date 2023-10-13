<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comunidades extends Model
{
    use HasFactory;

    public function agrupaciones()
    {
        return $this->belongsTo(agrupaciones::class, 'com_agr_id');
    }

    public function calles()
    {
        return $this->hasMany(calles::class, 'cal_com_id');
    }
}
