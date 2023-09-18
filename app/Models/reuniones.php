<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reuniones extends Model
{
    use HasFactory;

    protected $fillable = ['reu_eve_id', 'reu_tipo', 'reu_observacion', 'reu_estado'];

}
