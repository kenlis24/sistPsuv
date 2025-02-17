<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calles extends Model
{
    use HasFactory;

    protected $fillable = ['cal_codigo','cal_nombre', 'cal_estado'];

    public function comunidades()
    {
        return $this->belongsTo(comunidades::class, 'cal_com_id');
    }    

}
