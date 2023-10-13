<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calles extends Model
{
    use HasFactory;

    public function comunidades()
    {
        return $this->belongsTo(comunidades::class, 'cal_com_id');
    }    

}
