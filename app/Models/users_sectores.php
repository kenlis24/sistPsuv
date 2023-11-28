<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_sectores extends Model
{
    use HasFactory;

    protected $fillable = ['usec_sec_id', 'usec_use_id', 'usec_estado'];
}
