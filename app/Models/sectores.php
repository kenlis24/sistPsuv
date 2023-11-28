<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sectores extends Model
{
    use HasFactory;

    protected $fillable = ['sec_nombre', 'sec_estado'];
}
